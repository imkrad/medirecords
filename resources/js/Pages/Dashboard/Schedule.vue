<template>
<b-modal v-model="showModal" style="--vz-modal-width: 900px;" header-class="p-3 bg-primary-subtle" title="View Schedule" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
    <template v-if="type == 'visit'">
        <div class="table-responsive table-card" style=" height: calc(100vh - 545px)">
            <table class="table align-middle table-centered mb-0">
                <thead class="bg-primary text-white thead-fixed">
                    <tr class="fs-11">
                        <th style="width: 3%;"></th>
                        <th>Name</th>
                        <th style="width: 25%;" class="text-center">Appointment Code</th>
                        <th style="width: 25%;" class="text-center">Schedule</th>
                        <th style="width: 7%;"></th>
                    </tr>
                </thead>
                <tbody class="table-white">
                    <tr v-for="(list,index) in visits" v-bind:key="index" >
                        <td class="text-center"></td>
                        <td>
                            <h5 class="fs-13 mb-0 fw-semibold text-primary text-uppercase">{{list.af.appointment.patient.member.lastname}}</h5>
                        </td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td>
                          
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </template>
    <template v-slot:footer>
        <b-button @click="hide()" variant="light" block>Close</b-button>
    </template>
</b-modal>
</template>
<script>
export default {
    props: ['visits'],
    data(){
        return {
            type: null,
            showModal : false
        }
    },
    methods: { 
        show(type) {
            this.type = type;
            this.showModal = true;
        },
        hide() {
            this.showModal = false;
        }
    }
}
</script>