<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" title="Additional Information" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform" v-if="selected">
            <BRow class="g-3">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0 mt-0">
    <tbody>
        <tr>
            <th class="ps-0" scope="row">Blood Pressure :</th>
            <th class="text-primary">{{ selected.bp }}</th>
        </tr>
        <tr>
            <th class="ps-0" scope="row">Pulse Rate :</th>
            <th class="text-primary">{{ selected.pulse_rate }}</th>
        </tr>
        <tr>
            <th class="ps-0" scope="row">Temperature :</th>
            <th class="text-primary">{{ selected.temperature }}</th>
        </tr>
        <tr>
            <th class="ps-0" scope="row">Medical History :</th>
            <th class="text-primary">{{ selected.medical_history }}</th>
        </tr>
        <tr>
            <th class="ps-0" scope="row">Remarks :</th>
            <th class="text-primary">{{ selected.remarks ? selected.remarks : 'N/A' }}</th>
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
            if (typeof data === "string") {
            this.selected = JSON.parse(data); // Parse if it's a JSON string
        } else {
            this.selected = data;
        }
        this.showModal = true;
            this.showModal = true;
        },
       
        hide(){
            this.showModal = false;
        }
    }
}
</script>