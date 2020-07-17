<template>
    <div>
    <DataTable class="p-datatable-striped" :value="tareas" :expandedRows.sync="expandedRows" dataKey="id"
        @row-expand="onRowExpand" @row-collapse="onRowCollapse">
        <template #header>
            <div class="table-header-container">
                Lista de tareas
            </div>
        </template>
        <Column :expander="true" headerStyle="width: 3rem" />
        <Column field="nombre" header="Nombre" sortable></Column>
        <Column field="descripcion" header="Descripción" sortable></Column>
        <Column field="inicio" header="Inicio" sortable></Column>
        <Column field="fin" header="Fin" sortable></Column>
        <Column header="Estado actual" sortable>
        <template #body="slotProps">
            <span>{{slotProps.data.task_state[0].pivot.state_id}}</span>
        </template>
        </Column>
        <Column>
        <template #body="slotProps">
            <Button v-tooltip="'Editar tarea'" icon="pi pi-pencil" class="p-button-rounded p-button-success p-mr-2"  />
            <Button v-tooltip="'Modificar estado de tarea'" icon="pi pi-list" class="p-button-rounded p-button-warning"  />
        </template>
        </Column>
        <!-- <Column header="Image">
            <template #body="slotProps">
            <img :src="'demo/images/product/' + slotProps.data.image" :alt="slotProps.data.image" class="product-image" />
            </template>
        </Column> -->

        <template #expansion="slotProps">
            <div>

            </div>
        </template>
    </DataTable>
    </div>
</template>
<script>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';
import Button from 'primevue/button'

export default {
props:{
    latitud: Number,
    longitud: Number,
},
components:{
    DataTable,
    Column,
    ColumnGroup,
    Button
},
data(){
    return{
        tareas: [],
        expandedRows: [],

    }
},
mounted(){
    this.buscarTareas();
},
methods:{
    buscarTareas(){
        axios.get('/task/'+this.latitud+'/'+this.longitud)
        .then(resp=>{
            this.tareas = resp.data;
        })
        .catch(e=>{
            console.log(e);
        })
    },
    onRowExpand(event) {
        //this.$toast.add({severity: 'info', summary: 'Product Expanded', detail: event.data.name, life: 3000});
    },
    onRowCollapse(event) {
        //this.$toast.add({severity: 'success', summary: 'Product Collapsed', detail: event.data.name, life: 3000});
    },
}
}
</script>
