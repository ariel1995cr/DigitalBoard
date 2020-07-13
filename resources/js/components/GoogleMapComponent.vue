<template>
    <div class="fluid-container border border-primary" style="margin: 0px;">
        <GmapMap
        :center="{lat:10, lng:10}"
        :zoom="7"
        map-type-id="terrain"
        style="width: 100%; height: 94%; position:fixed"
        >
        <GmapMarker
            :key="index"
            v-for="(m, index) in markers"
            :position="m.position"
            :clickable="true"
            :draggable="false"
            @click="center=m.position"
        />
        </GmapMap>
    </div>
</template>

<script>
export default{
  data () {
    return {
        markers: [{
            position: {
              lat: 10.0,
              lng: 10.0
            }
          }, {
            position: {
              lat: 11.0,
              lng: 11.0
            }
          }
          ],
    }
  }
}
</script>

<style scoped>

</style>
