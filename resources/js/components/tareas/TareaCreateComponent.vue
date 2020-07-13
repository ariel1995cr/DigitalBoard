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
                            />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Fecha inicio</label>
                            <InputMask
                                v-model="task.inicio"
                                class="form-control"
                                mask="99/99/9999"
                                slotChar="dd/mm/yyyy"
                            />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Fecha fin</label>
                            <InputMask
                                v-model="task.fin"
                                class="form-control"
                                mask="99/99/9999"
                                slotChar="dd/mm/yyyy"
                            />
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Existe ubicación?</label>
                            <InputSwitch v-model="existeUbicacion" />
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Dirección</label>
                            <MultiSelect class="w-100" v-model="carselected" :options="cars" optionLabel="brand" placeholder="Seleccionar ubicación" v-if="existeUbicacion"/>
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
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
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

export default {
    components: {
        InputText,
        InputMask,
        InputSwitch,
        MultiSelect
    },
    data() {
        return {
            task: {
                nombre: "",
                inicio: "",
                fin: "",
                descripcion: "",
                created_at: "",
                updated_at: ""
            },
            ubication: {
                latitud: "",
                longitud: "",
                nombre: ""
            },
            existeUbicacion: true,
            place: null,
            markers: [],
            carselected: null,
            cars: [
			{brand: 'Audi', value: 'Audi'},
			{brand: 'BMW', value: 'BMW'},
			{brand: 'Fiat', value: 'Fiat'},
			{brand: 'Honda', value: 'Honda'},
			{brand: 'Jaguar', value: 'Jaguar'},
			{brand: 'Mercedes', value: 'Mercedes'},
			{brand: 'Renault', value: 'Renault'},
			{brand: 'Volkswagen', value: 'Volkswagen'},
			{brand: 'Volvo', value: 'Volvo'}
		    ],
        };
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
                this.ubication.nombre = this.place.formatted_address;
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
        }
    }
};
</script>
