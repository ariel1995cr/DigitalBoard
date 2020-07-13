<template>
    <div class="fluid-container border border-primary" style="margin: 0px;">
        <GmapMap
        :center="{lat:10, lng:10}"
        :zoom="7"
        map-type-id="terrain"
        style="width: 100%; height: 94%; position:fixed"
        >
        <GmapInfoWindow  :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen" @closeclick="infoWinOpen=false">
        <!-- some html here -->
        </GmapInfoWindow>
        <GmapMarker
            :key="index"
            v-for="(m, index) in markers"
            :position="m.task_ubication.position"
            :clickable="true"
            :draggable="false"
            @click="toggleInfoWindow(m,index)"
        />
        </GmapMap>
    </div>
</template>

<script>

export default{// replace src with dist if you have Babel issues
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
                value.task_ubication.position = {
                    lat: Number(value.task_ubication.latitud),
                    lng: Number(value.task_ubication.longitud)
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
            this.infoContent = marker.infoText;

            //check if its the same marker that was selected if yes toggle
            if (this.currentMidx == idx) {
              this.infoWinOpen = !this.infoWinOpen;
            }
            //if different marker set infowindow to open and reset current marker index
            else {
              this.infoWinOpen = true;
              this.currentMidx = idx;

            }
          }
},
}
</script>
<style scoped>

</style>
