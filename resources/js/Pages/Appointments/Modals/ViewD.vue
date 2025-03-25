<template>
    <b-modal v-model="showModal"  header-class="p-3 bg-light" title="View Dropout Reason" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform" v-if="selected">
            <BRow class="g-3">
                <div class="table-responsive">
                    <table class="table tablez table-bordered table-nowrap align-middle mb-0 mt-2">
                        <thead class="bg-primary text-white">
                            <tr class="fs-10">
                                <th class="text-center" width="50%">Reason</th>
                                <th class="text-center" width="50%">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr>
                               <td class="text-center">{{ selected.reason.name }}</td>
                               <td class="text-center">{{ selected.dropout_at }}</td>
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