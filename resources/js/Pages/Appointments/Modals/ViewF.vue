<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 750px;" header-class="p-3 bg-light" title="View Checkup" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform" v-if="selected">
            <BRow class="g-3">
                <div class="table-responsive">
                    <table class="table tablez table-bordered table-nowrap align-middle mb-0 mt-2">
                        <thead class="bg-primary text-white">
                            <tr class="fs-10">
                                <th class="text-center" width="50%">Type</th>
                                <th class="text-center" width="25%">Count</th>
                                <th class="text-center" width="25%">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr>
                               <td class="text-center">{{ selected.type.name }}</td>
                               <td class="text-center">{{ (selected.count) ? selected.count : '-'}}</td>
                               <td class="text-center">{{ selected.date_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </BRow>
        </form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Close</b-button>
        </template>
    </b-modal>
</template>
<script>
export default {
    data(){
        return {
            currentUrl: window.location.origin,
            selected: null,
            showModal: false
        }
    },  
    methods: { 
        show(data){
            this.selected = data;
            this.showModal = true;
        },
       
        hide(){
            this.showModal = false;
        }
    }
}
</script>