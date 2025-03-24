<template>
    <table class="table tablez table-bordered table-nowrap align-middle mb-0 mt-2">
        <thead class="bg-primary text-white">
            <tr class="fs-10">
                <th class="text-center" colspan="3" width="10%">Prenatal Check-ups</th>
                <th class="text-center" colspan="6" width="10%">Immunization Status</th>
                <th class="text-center" width="15%">Micronutrient Supplementation</th>
                <th class="text-center" width="10%">Nutritional Assessment</th>
                <th class="text-center" width="10%">Deworming Tablet</th>
                <th class="text-center" width="15%">Infectious Disease Surveillance</th>
                <th class="text-center" width="10%">Laboratory Screening</th>
            </tr>
            <tr class="fs-10">
                <th class="text-center">1st Tri</th>
                <th class="text-center">2nd Tri</th>
                <th class="text-center">3rd Tri</th>
                <th class="text-center">TT1</th>
                <th class="text-center">TT2</th>
                <th class="text-center">TT3</th>
                <th class="text-center">TT4</th>
                <th class="text-center">TT5</th>
                <th class="text-center">-</th>
            </tr>
        </thead> 
        </table>
</template>
<script>
export default {
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
        openDropout(){
            this.$refs.dropout.show(this.appointment.id);
        },
        openSchedule(){
            this.$refs.schedule.show(this.appointment.family.id);
        },
        openVisit(id){
            this.$refs.visit.show(id);
        },
        openView(id){
            this.$refs.view.show(id);
        }
    }
}
</script>