<template>
    <!-- <table class="table tablez table-bordered table-nowrap align-middle mb-0 mt-2">
        <thead class="bg-primary text-white">
            <tr class="fs-10">
                <th class="text-center" colspan="2" width="10%">Child Protected at Birth</th>
                <th class="text-center" colspan="5" width="10%">Newborn (0-28 days old)</th>
                <th class="text-center" colspan="4" width="15%">1-3 months</th>
                <th class="text-center" width="10%">6-11 months</th>
                <th class="text-center" width="10%">12 months old</th>
                <th class="text-center" width="15%">CIC</th>
                <th class="text-center" width="10%">0-11 months</th>
            </tr>
            <tr class="fs-10">
                <th class="text-center">TT2/TD2</th>
                <th class="text-center">TT3/TD3</th>
                <th class="text-center">Length</th>
                <th class="text-center">Weight</th>
                <th class="text-center">Status</th>
                <th class="text-center">Immunization</th>
                <th class="text-center">Breast Feeding</th>
                <th class="text-center">Nutritional Status Assessment</th>
                <th class="text-center">Birth Weight</th>
                <th class="text-center">Immunization</th>
                <th class="text-center">Breast Feeding</th>
                <th class="text-center">TT5</th>
                <th class="text-center">-</th>
            </tr>
        </thead> 
    </table> -->
    <BCol lg="6">
        <div class="table-responsive mt-4">
            <simplebar style="height: calc(100vh - 450px);">
            <table class="table table-nowrap table-striped align-middle mb-0">
                <thead class="bg-primary thead-fixed">
                    <tr class="fs-13 fw-bold text-white">
                        <th colspan="6">Nutritional Status Assessment</th>
                        <th class="text-end">
                            <button @click="openNas()" type="button" class="btn btn-light btn-sm material-shadow-none mt-n2 mb-n2">
                                Add Nas
                            </button>
                        </th>
                    </tr>
                    <tr class="fs-10 bg-light">
                        <th style="width: 4%;">#</th>
                        <th>Range</th>
                        <th style="width: 10%;" class="text-center">Age</th>
                        <th style="width: 10%;" class="text-center">Length</th>
                        <th style="width: 10%;" class="text-center">Weight</th>
                        <th style="width: 20%;" class="text-center">Status</th>
                        <th style="width: 20%;" class="text-center">Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white fs-12">
                    <tr v-for="(list,index) in a.data.immunization.nsas" v-bind:key="index" >
                        <td>{{ index+1 }}</td>
                        <td>{{ list.range.name }}</td>
                        <td class="text-center">{{ list.age }}</td>
                        <td class="text-center">{{ list.length }}</td>
                        <td class="text-center">{{ list.weight }}</td>
                        <td class="text-center">{{ list.status.name }}</td>
                        <td class="text-center">{{ list.date_at }}</td>
                    </tr>
                </tbody>
            </table></simplebar>
        </div>
    </BCol>
    <BCol lg="6">
        <div class="table-responsive mt-4">
            <simplebar style="height: calc(100vh - 450px);">
            <table class="table table-nowrap table-striped align-middle mb-0">
                <thead class="bg-primary thead-fixed">
                    <tr class="fs-13 fw-bold text-white">
                        <th colspan="5">Immunization</th>
                        <th class="text-end">
                            <button @click="openConfirm()" type="button" class="btn btn-light btn-sm material-shadow-none mt-n2 mb-n2">
                                Add Immunization
                            </button>
                        </th>
                    </tr>
                    <tr class="fs-10 bg-light">
                        <th style="width: 4%;">#</th>
                        <th>Vaccine</th>
                        <th style="width: 20%;" class="text-center">Dose</th>
                        <!-- <th style="width: 20%;" class="text-center">Range</th> -->
                        <th style="width: 20%;" class="text-center">Date</th>
                        <th style="width: 20%;" class="text-center">Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="bg-white fs-12">
                    <tr v-for="(list,index) in a.data.immunization.lists" v-bind:key="index" >
                        <td>{{ index+1 }}</td>
                        <td>{{ list.vaccine.vaccine.short }}</td>
                        <td class="text-center">{{ toOrdinal(list.vaccine.dose) }}</td>
                        <!-- <td class="text-center">{{ list.range.name }}</td> -->
                        <td class="text-center">{{ list.date_at }}</td>
                        <td class="text-center">
                            <span v-if="list.is_completed" class="badge bg-success">Completed</span>
                            <span v-else class="badge bg-warning">Pending</span>
                        </td>
                        <td class="text-center" >
                            <button v-if="!list.is_completed" @click="openConfirm(list)" type="button" class="btn btn-primary btn-sm material-shadow-none mt-n2 mb-n2">
                                Confirm
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table></simplebar>
        </div>
    </BCol>
    <Nas :dropdowns="dropdowns" ref="nas"/>
    <Immunization ref="immunization"/>
</template>
<script>
import Nas from '../Modals/Nas.vue';
import Immunization from '../Modals/Immunuzation.vue';
export default {
    components: { Nas, Immunization },
    props:['a','appointment','dropdowns'],
    data(){
        return {
            months: [
                { name: "January", value: 1 },
                { name: "February", value: 2 },
                { name: "March", value: 3 },
                { name: "April", value: 4 },
                { name: "May", value: 5 },
                { name: "June", value: 6 },
                { name: "July", value: 7 },
                { name: "August", value: 8 },
                { name: "September", value: 9 },
                { name: "October", value: 10 },
                { name: "November", value: 11 },
                { name: "December", value: 12 },
            ],
        }
    },
    methods: {
        openConfirm(data){
            this.$refs.immunization.show(data);
        },
        openNas(){
            this.$refs.nas.show(this.appointment.id,this.appointment);
        },
        toOrdinal(n) {
            const s = ["th", "st", "nd", "rd"];
            const v = n % 100;
            return n + (s[(v - 20) % 10] || s[v] || s[0]);
        }
    }
}
</script>