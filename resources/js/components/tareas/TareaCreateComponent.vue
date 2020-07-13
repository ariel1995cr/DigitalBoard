<template>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear tarea</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/profile">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="inputEmail4">Nombre</label>
                            <InputText
                                type="text"
                                class="form-control"
                                placeholder=""
                                v-model="task.nombre"
                            />
                            <InlineMessage class="w-100" v-if="this.errores['task.nombre']">
                                    <p v-bind:key="index" v-for="(error,index) in this.errores['task.nombre']">
                                    {{error}}
                                    </p>
                            </InlineMessage>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Fecha inicio</label>
                            <InputMask
                                v-model="task.inicio"
                                class="form-control"
                                mask="99-99-9999"
                                slotChar="dd-mm-yyyy"
                            />
                            <InlineMessage class="w-100" v-if="this.errores['task.inicio']">
                                    <p v-bind:key="index" v-for="(error,index) in this.errores['task.inicio']">
                                    {{error}}
                                    </p>
                            </InlineMessage>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Fecha fin</label>
                            <InputMask
                                v-model="task.fin"
                                class="form-control"
                                mask="99-99-9999"
                                slotChar="dd-mm-yyyy"
                            />
                            <InlineMessage class="w-100" v-if="this.errores['task.fin']">
                                <p v-bind:key="index" v-for="(error,index) in this.errores['task.fin']">
                                    {{error}}
                                </p>
                            </InlineMessage>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Existe ubicación?</label>
                            <br>
                            <InputSwitch @change="cambioUbicacion" v-model="existeUbicacion" />
                        </div>

                        <div class="form-group col-md-6" v-if="!existeUbicacion">
                            <label for="inputEmail4">Nombre ubicación</label>
                            <InputText
                                v-model="ubication.nombre"
                                type="text"
                                class="form-control"
                                placeholder=""
                            />
                            <InlineMessage class="w-100" v-if="this.errores['ubication.nombre']">
                                <p v-bind:key="index" v-for="(error,index) in this.errores['ubication.nombre']">
                                    {{error}}
                                </p>
                            </InlineMessage>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Dirección</label>
                            <Dropdown class="w-100" v-model="ubication" :options="ubicaciones" optionLabel="nombre" :filter="true" placeholder="Seleccionar ubicación" :showClear="true" v-if="existeUbicacion">
                                <template class="w-100" #value="slotProps">
                                    <div v-if="slotProps.value">
                                        <div>{{slotProps.value.nombre}} | lat: {{slotProps.value.latitud}} lng: {{slotProps.value.longitud}}</div>
                                    </div>
                                    <span v-else>
                                        {{slotProps.placeholder}}
                                    </span>
                                </template>
                            </Dropdown>

                            <GmapAutocomplete
                                :options="{
                                    fields: [
                                        'geometry',
                                        'address_components',
                                        'formatted_address'
                                    ]
                                }"
                                class="form-control"
                                @place_changed="setPlace"
                                v-else=""
                            ></GmapAutocomplete>
                            <InlineMessage class="w-100" v-if="this.errores['ubication.direccion']">
                                <p v-bind:key="index" v-for="(error,index) in this.errores['ubication.direccion']">
                                    {{error}}
                                </p>
                            </InlineMessage>
                        </div>
                        <GmapMap
                            style="width: 600px; height: 300px;"
                            :zoom="1"
                            :center="{ lat: 0, lng: 0 }"
                        >
                            <GmapMarker
                                v-for="(marker, index) in markers"
                                :key="index"
                                :position="marker.position"
                            />
                            <GmapMarker
                                v-if="this.place"
                                label="★"
                                :position="{
                                    lat: this.place.geometry.location.lat(),
                                    lng: this.place.geometry.location.lng()
                                }"
                            />
                        </GmapMap>
                        <div class="form-group col-md-6" v-if="!existeUbicacion">
                            <label for="inputEmail4">Latitud</label>
                            <InputText
                                @change="ubicacionModificada"
                                v-model.number.lazy="ubication.latitud"
                                type="text"
                                class="form-control"
                                placeholder=""
                            />
                            <InlineMessage class="w-100" v-if="this.errores['ubication.latitud']">
                                <p v-bind:key="index" v-for="(error,index) in this.errores['ubication.latitud']">
                                    {{error}}
                                </p>
                            </InlineMessage>
                        </div>
                        <div class="form-group col-md-6" v-if="!existeUbicacion">
                            <label for="inputEmail4">Longitud</label>
                            <InputText
                                @change="ubicacionModificada"
                                v-model.number.lazy="ubication.longitud"
                                type="text"
                                class="form-control"
                                placeholder=""
                            />
                            <InlineMessage class="w-100" v-if="this.errores['ubication.longitud']">
                                <p v-bind:key="index" v-for="(error,index) in this.errores['ubication.longitud']">
                                    {{error}}
                                </p>
                            </InlineMessage>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <Button @click="crearTarea()" label="Crear" class="p-button-raised p-button-text" />
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                >
                    Close
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import InputText from "primevue/inputtext";
import InputMask from "primevue/inputmask";
import InputSwitch from 'primevue/inputswitch';
import MultiSelect from 'primevue/multiselect';
import Button from 'primevue/button';
import Toast from 'primevue/toast';
import InlineMessage from 'primevue/inlinemessage';
import Dropdown from 'primevue/dropdown';


export default {
    components: {
        InputText,
        InputMask,
        InputSwitch,
        MultiSelect,
        Button,
        InlineMessage,
        Dropdown
    },
    data() {
        return {
            task: {
                nombre: "",
                ubicacion_id: "",
                inicio: "",
                fin: "",
                descripcion: "",
                created_at: "",
                updated_at: ""
            },
            ubication: null,
            existeUbicacion: true,
            place: null,
            markers: [],
            carselected: null,
            ubicaciones: [],
            errores:{

            }
        };
    },
    mounted() {
        this.obtenerUbicaciones();
    },
    methods: {
        setPlace(place) {
            this.place = place;
            this.usePlace(place);
        },
        usePlace(place) {
            this.markers = [];
            if (this.place) {
                this.markers.push({
                    position: {
                        lat: this.place.geometry.location.lat(),
                        lng: this.place.geometry.location.lng()
                    }
                });
                this.ubication.latitud = this.place.geometry.location.lat();
                this.ubication.longitud = this.place.geometry.location.lng();
                this.ubication.direccion = this.place.formatted_address;
                console.log(this.place);
                this.place = null;
            }
        },
        ubicacionModificada() {
            this.markers[0].position.lat = this.ubication.latitud;
            this.markers[0].position.lng = this.ubication.longitud;
            Vue.$geocoder.setDefaultMode("lat-lng");
            var latLngObj = {
                lat: this.ubication.latitud,
                lng: this.ubication.longitud
            };
            Vue.$geocoder.send(latLngObj, response => {
                console.log(response);
            });
        },
        crearTarea () {
            axios.post('/task',{
                task: this.task,
                ubication: this.ubication,
                existeUbicacion: this.existeUbicacion,
            }).then(response=>{
                console.log(response.data);
            }).catch(e => {
                console.log(e)
                console.log(e.response)
                this.errores = e.response.data.errors;
                this.$toast.add({severity:'success', summary: 'Success Message', detail:'Order submitted', life: 3000});
            });
        },
        obtenerUbicaciones(){
            axios.get('/ubication')
            .then(response=>{
                this.ubicaciones = response.data;
            })
            .catch(e=>{
                console.log(e);
            })
        },
        cambioUbicacion(){
            this.ubication = {};
        },
    }
};
</script>
