<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" title="Visit Date" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform" v-if="selected">
            <BRow class="g-3">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0 mt-0">
                        <tbody>
                            <tr>
                                <th class="ps-0" scope="row">Scheduled Date :</th>
                                <th class="text-primary">{{selected.schedule_date}}</th>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">Visited Date :</th>
                                <th class="text-primary">{{selected.visited_date}}</th>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">Remarks :</th>
                                <th class="text-primary">{{selected.remarks}}</th>
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