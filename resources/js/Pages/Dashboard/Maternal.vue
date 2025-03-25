<template lang="">
    <Head title="Technical Service Requests"/>
    <div class="auth-page-wrapper d-flex min-vh-100">
        <div class="auth-page-content">
            <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
                <div class="file-manager-content w-100 p-4 pb-0" ref="box">
                    <table class="table table-bordered table-nowrap align-middle mb-0 mt-2">
                        <thead class="bg-primary text-white">
                            <tr class="fs-10">
                                <th class="text-center" colspan="3">Prenatal Check-ups</th>
                                <th class="text-center" colspan="6">Immunization Status</th>
                                <th class="text-center" colspan="8">Micronutrient Supplementation</th>
                                <th class="text-center">Nutritional Assessment</th>
                                <th class="text-center">Deworming Tablet</th>
                                <th class="text-center" colspan="3">Infectious Disease Surveillance</th>
                                <th class="text-center" colspan="2">Laboratory Screening</th>
                            </tr>
                            <tr class="fs-10">
                                <th class="text-center align-middle" rowspan="2">1st Tri</th>
                                <th class="text-center align-middle" rowspan="2">2nd Tri</th>
                                <th class="text-center align-middle" rowspan="2">3rd Tri</th>
                                <th class="text-center" colspan="5">Tetanus Diphtheria/Toxoid</th>
                                <th class="text-center">FIM</th>
                                <th class="text-center" colspan="4">Iron Sulfate</th>
                                <th class="text-center" colspan="3">Calcium Carbonate</th>
                                <th class="text-center">Iodine Capsules</th>
                                <th class="text-center align-middle" rowspan="2">-</th>
                                <th class="text-center align-middle" rowspan="2">-</th>
                                <th class="text-center align-middle" rowspan="2">Screening</th>
                                <th class="text-center align-middle" rowspan="2">Hepatitis B</th>
                                <th class="text-center align-middle" rowspan="2">HIV</th>
                                <th class="text-center align-middle" rowspan="2">Gestational Diabetes</th>
                                <th class="text-center align-middle" rowspan="2">CBC/HGB/HCT</th>
                            </tr>
                            <tr class="fs-10">
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                                <th class="text-center">5</th>
                                <th class="text-center">-</th>
                                <th class="text-center">1st Tri</th>
                                <th class="text-center">2nd Tri</th>
                                <th class="text-center">3rd Tri</th>
                                <th class="text-center">4th Tri</th>
                                <th class="text-center">2nd Tri</th>
                                <th class="text-center">3rd Tri</th>
                                <th class="text-center">4th Tri</th>
                                <th class="text-center">1st Tri</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr>
                                <!-- <td class="text-center" v-for="(list,index) in results" v-bind:key="index" style="cursor: pointer;" @click="openView(list)">
                                    <i v-if="list.length > 0" class="text-success fs-16 ri-checkbox-circle-fill"></i>
                                    <i v-else class="text-danger fs-16 ri-close-circle-line"></i>
                                </td> -->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    layout: null,
    props: ['lists'],
    methods: {
        handleClick(index, value) {
            if (index > 11) {
                if(value){
                    if(index == 15){
                        this.$refs.viewd.show(value);
                    }else{
                        this.$refs.viewf.show(value);
                    }
                }
            }
        }
    }
}
</script>
<style scoped>
.auth-page-wrapper .auth-page-content {
    padding-bottom: 0px;
  width: 100%;
  overflow: hidden;
  background-color: #f3f3f9;
}
.file-manager-sidebar {
  min-width: 24%;
  max-width: 24%;
  height: calc(100vh - 92px);
}
</style>
