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
                                v-model="task.nombre"
                                class="form-control"
                                :class="{'is-invalid': this.errores['task.nombre']}"
                                placeholder=""
                                
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
                                :class="{'is-invalid': this.errores['task.inicio']}"
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
                                :class="{'is-invalid': this.errores['task.fin']}"
                                mask="99-99-9999"
                                slotChar="dd-mm-yyyy"
                            />
                            <InlineMessage class="w-100" v-if="this.errores['task.fin']">
                                <p v-bind:key="index" v-for="(error,index) in this.errores['task.fin']">
                                    {{error}}
                                </p>
                            </InlineMessage>
                        </div>
                        <div class="form-group col-12">
                        <SelectButton :class="{'is-invalid': this.errores['task.tipoIngreso']}" v-model="task.tipoIngreso" :options="opcionesdeUbicacion" />
                        <InlineMessage class="w-100" v-if="this.errores['task.tipoIngreso']">
                            <p v-bind:key="index" v-for="(error,index) in this.errores['task.tipoIngreso']">
                                {{error}}
                            </p>
                        </InlineMessage>
                        </div>


                        <div class="form-group col-md-12" v-if="task.tipoIngreso === 'Direccion'">
                            <label for="inputEmail4">Dirección</label>

                            <GmapAutocomplete
                                :options="{
                                    fields: [
                                        'geometry',
                                        'address_components',
                                        'formatted_address'
                                    ]
                                }"
                                class="form-control"
                                :class="{'is-invalid': this.errores['task.direccion']}"
                                @place_changed="setPlace"
                            ></GmapAutocomplete>

                            <InlineMessage class="w-100" v-if="this.errores['task.direccion']">
                            <p v-bind:key="index" v-for="(error,index) in this.errores['task.direccion']">
                                {{error}}
                            </p>
                        </InlineMessage>
                        </div>

                        <div class="row" v-if="task.tipoIngreso === 'Coordenadas'">
                            <div class="form-group col">
                                <label for="inputEmail4">Latitud</label>
                                <InputText
                                    @change="ubicacionModificada"
                                    v-model.number.lazy="task.latitud"
                                    type="text"
                                    class="form-control"
                                    :class="{'is-invalid': this.errores['task.latitud']}"
                                    placeholder=""
                                />
                                <InlineMessage class="w-100" v-if="this.errores['task.latitud']">
                                    <p v-bind:key="index" v-for="(error,index) in this.errores['task.latitud']">
                                        {{error}}
                                    </p>
                                </InlineMessage>
                            </div>
                            <div class="form-group col">
                                <label for="inputEmail4">Longitud</label>
                                <InputText
                                    @change="ubicacionModificada"
                                    v-model.number.lazy="task.longitud"
                                    type="text"
                                    class="form-control"
                                    :class="{'is-invalid': this.errores['task.longitud']}"
                                    placeholder=""
                                />
                                <InlineMessage class="w-100" v-if="this.errores['task.longitud']">
                                    <p v-bind:key="index" v-for="(error,index) in this.errores['task.longitud']">
                                        {{error}}
                                    </p>
                                </InlineMessage>
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label for="inputEmail4">Descripción</label>
                            <Textarea class="form-control" :class="{'is-invalid': this.errores['task.descripcion']}" v-model="task.descripcion" :autoResize="true" rows="3" cols="30" />
                        </div>

                        <GmapMap
                            style="width: 600px; height: 300px;"
                            :zoom="1"
                            :center="{ lat: 0, lng: 0 }"
                            :options="{
                            zoomControl: false,
                            mapTypeControl: false,
                            scaleControl: false,
                            streetViewControl: false,
                            rotateControl: false,
                            fullscreenControl: false,
                            disableDefaultUI: false
                            }"
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



                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <Button @click="crearTarea()" label="Crear" class="p-button-raised" />
                <Button label="Cerrar" data-dismiss="modal" class="ml-3 p-button-raised p-button-secondary" />
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
import SelectButton from 'primevue/selectbutton';
import Textarea from 'primevue/textarea';


export default {
    components: {
        InputText,
        InputMask,
        InputSwitch,
        MultiSelect,
        Button,
        InlineMessage,
        Dropdown,
        SelectButton,
        Textarea
    },
    data() {
        return {
            task: {
                nombre: "",
                latitud: "",
                longitud: "",
                inicio: "",
                direccion:"",
                fin: "",
                descripcion: "",
                created_at: "",
                updated_at: "",
                tipoIngreso: 'Direccion',
            },
            place: null,
            markers: [],
            ubicaciones: [],
            opcionesdeUbicacion: ['Direccion','Coordenadas'],
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
                this.task.latitud = this.place.geometry.location.lat();
                this.task.longitud = this.place.geometry.location.lng();
                this.task.direccion = this.place.formatted_address;
                this.place = null;
            }
        },
        ubicacionModificada() {
            if(this.task.latitud === '' || this.task.longitud ===''){
                return ;
            }

            if(this.markers[0] === undefined){
                this.markers.push({
                    position: {
                        lat: Number(32),
                        lng: Number(45)
                    }
                });
            }

            this.markers[0].position.lat = this.task.latitud;
            this.markers[0].position.lng = this.task.longitud;
            Vue.$geocoder.setDefaultMode("lat-lng");
            var latLngObj = {
                lat: this.task.latitud,
                lng: this.task.longitud
            };
            Vue.$geocoder.send(latLngObj, response => {
                console.log(response);
            });
        },
        crearTarea () {
            axios.post('/task',{
                task: this.task,
            }).then(response=>{
                 $('#exampleModal').modal('toggle');
                this.$toast.add({severity:'success', summary: 'Tarea creada', detail:'Su tarea se ha creado satisfactoriamente.', life: 3000});
                location.reload();
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
