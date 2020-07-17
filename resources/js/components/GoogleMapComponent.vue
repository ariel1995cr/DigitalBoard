<template>
    <div class="fluid-container border border-primary" style="margin: 0px;">
        <GmapMap
        :center="{lat:10, lng:10}"
        :zoom="7"
        map-type-id="terrain"
        style="width: 100%; height: 94%; position:fixed"
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
        <GmapInfoWindow :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen" @closeclick="infoWinOpen=false" @mouseout="infoWinOpen=false">
            <div class="row no-gutters position-relative" style="background-color: #457b9d !important">
                <div class="col-12 position-static p-4">
                    <h2>Información de marcador</h2>
                    <h5 class="mt-0">Latitud: {{infoContent.latitud}} Longitud: {{infoContent.longitud}}</h5>
                    <h5 class="mt-0">Cantidad de tareas: {{infoContent.totalTareas}}</h5>
                    <Button @click="showModalTask = true" label="Ver tareas" style="background-color: white" class="p-button-raised p-button-text" />
                </div>
            </div>
        </GmapInfoWindow>
        <GmapMarker
            :key="index"
            v-for="(m, index) in markers"
            :position="m.position"
            :clickable="true"
            :draggable="false"
            @mouseover="toggleInfoWindow(m,index)"
        />
        </GmapMap>

        <Dialog header="Información" :closable=true :visible.sync="showModalTask" :style="{width: '50vw'}" :modal="true">
            <ModalTareas :latitud="Number(infoContent.latitud)" :longitud="Number(infoContent.longitud)"></ModalTareas>
        </Dialog>
    </div>
</template>

<script>
import Button from 'primevue/button';
import ModalTareas from '../components/tareas/ListadoTareaComponent';
import Dialog from 'primevue/dialog';
export default{// replace src with dist if you have Babel issues
  components:{
    Button,
    ModalTareas,
    Dialog
  },
  data () {
    return {
        markers: [],
        infoContent: '',
        infoWindowPos: null,
        infoWinOpen: false,
        currentMidx: null,
        //optional: offset infowindow so it visually sits nicely on top of our marker
        infoOptions: {
            pixelOffset: {
                width: 0,
                height: -35
            }

        },
        showModalTask: false,
    }
  },
  mounted() {
      this.listarTareas();
  },
  methods: {
      listarTareas() {
          axios.get('/task')
          .then(response=>{
              response.data.map(function(value, key){
                value.position = {
                    lat: Number(value.latitud),
                    lng: Number(value.longitud)
                };
              })
              this.markers = response.data;
          })
          .catch(e=>{
              console.log(e);
          })
      },
       toggleInfoWindow (marker, idx) {
            this.infoWindowPos = marker.position;
            this.infoContent = marker;

            //check if its the same marker that was selected if yes toggle
            if (this.currentMidx == idx) {
              this.infoWinOpen = !this.infoWinOpen;
            }
            //if different marker set infowindow to open and reset current marker index
            else {
              this.infoWinOpen = true;
              this.currentMidx = idx;

            }
          },
},
}
</script>
<style>
.gm-style-iw{
    background-color: #1d3557 !important;
    color: #a8dadc !important;
    box-shadow: 5px 5px #002855, -1em 0 1em #7bdff2;
    font-size: 20px !important;
}
.gm-style{
    background-color: #1d3557 !important;
}
.gm-style-iw-t{
    background-color: #1d3557 !important;
}
.gm-style-iw-t::after{
    background: #1d3557 !important;
}
</style>
