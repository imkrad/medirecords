<template lang="">
    <Head title="Technical Service Requests"/>
    <div class="auth-page-wrapper d-flex min-vh-100">
        <div class="auth-page-content">
            <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
                <div class="file-manager-content w-100 p-4 pb-0" ref="box">
                    <table class="table table-bordered table-nowrap align-middle">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th colspan="54" class="text-center align-middle">Immunization and Nutrition Service</th>
                            </tr>
                            <tr class="fs-10">
                                <th class="text-center align-middle" rowspan="3" style="width: 4%;">Registration</th>
                                <th class="text-center align-middle" rowspan="3" style="width: 3%;">Serial No.</th>
                                <th class="text-center align-middle" rowspan="3" style="width: 8%;">Name of Child</th>
                                <th class="text-center align-middle" rowspan="3">Sex</th>
                                <th class="text-center align-middle" colspan="2" rowspan="1" style="width: 3.5%;">Child Protected at Birth</th>
                                <th class="text-center" colspan="6" rowspan="1" width="10%">Newborn (0-28 days old)</th>
                                <th class="text-center" colspan="15" rowspan="1" width="15%">1-3 months</th>
                                <th class="text-center" colspan="11" rowspan="1" width="10%">6-11 months</th>
                                <th class="text-center" colspan="6" rowspan="1" width="10%">12 months old</th>
                                <th class="text-center" rowspan="3" width="5%">CIC</th>
                                <th class="text-center" colspan="8" rowspan="1" width="10%">0-11 months</th>
                                <th class="text-center" rowspan="3" width="5%">Remarks</th>
                            </tr>
                            <tr class="fs-10">
                                <th class="text-center align-middle" rowspan="2">TT2/TD2</th>
                                <th class="text-center align-middle" rowspan="2">TT3/TD3</th>
                                <th class="text-center align-middle" rowspan="2">Length</th>
                                <th class="text-center align-middle" rowspan="2">Weight</th>
                                <th class="text-center align-middle" rowspan="2">Breast Feeding</th>
                                <th class="text-center align-middle" rowspan="2">Status</th>
                                <th class="text-center align-middle" colspan="2">Immunization</th>
                                <th class="text-center align-middle" colspan="4">Breast Feeding</th>
                                <th class="text-center align-middle" colspan="4">Nutritional Status Assessment</th>
                                <th class="text-center align-middle" colspan="3">Birth Weight</th>
                                <th class="text-center align-middle" colspan="4">Immunization</th>
                                <th class="text-center align-middle" colspan="4">Nutritional Status Assessment</th>
                                <th class="text-center align-middle" colspan="2">Complementary Feeding</th>
                                <th class="text-center align-middle" rowspan="2">Exclusively Breastfed</th>
                                <th class="text-center align-middle" rowspan="2">Vitamin A</th>
                                <th class="text-center align-middle" rowspan="2">MNP</th>
                                <th class="text-center align-middle" rowspan="2">MMR Dose 1</th>
                                <th class="text-center align-middle" rowspan="2">IPV Dose 2</th>
                                <th class="text-center align-middle" colspan="4">Nutritional Status Assessment</th>
                                <th class="text-center align-middle" rowspan="2">MMR Dose 2</th>
                                <th class="text-center align-middle" rowspan="2">FIC Date</th>
                                <th class="text-center align-middle" colspan="4">MAM</th>
                                <th class="text-center align-middle" colspan="4">SAM</th>
                            </tr>
                            <tr>
                                <th class="text-center align-middle">BCG</th>
                                <th class="text-center align-middle">Hepa B</th>
                                <th class="text-center align-middle">1 1/2</th>
                                <th class="text-center align-middle">2 1/2</th>
                                <th class="text-center align-middle">3 1/2</th>
                                <th class="text-center align-middle">4-5</th>
                                <th class="text-center align-middle">Age</th>
                                <th class="text-center align-middle">Length</th>
                                <th class="text-center align-middle">Weight</th>
                                <th class="text-center align-middle">Status</th>
                                <th class="text-center align-middle">1 mos.</th>
                                <th class="text-center align-middle">2 mos.</th>
                                <th class="text-center align-middle">3 mos.</th>
                                <th class="text-center align-middle">DPT-HIB-HepB</th>
                                <th class="text-center align-middle">OPV</th>
                                <th class="text-center align-middle">PCV</th>
                                <th class="text-center align-middle">IPV</th>
                                <th class="text-center align-middle">Age</th>
                                <th class="text-center align-middle">Length</th>
                                <th class="text-center align-middle">Weight</th>
                                <th class="text-center align-middle">Status</th>
                                <th class="text-center align-middle">Y/N</th>
                                <th class="text-center align-middle">1/2</th>
                                <th class="text-center align-middle">Age</th>
                                <th class="text-center align-middle">Length</th>
                                <th class="text-center align-middle">Weight</th>
                                <th class="text-center align-middle">Status</th>
                                <th class="text-center align-middle">Admitted</th>
                                <th class="text-center align-middle">Cured</th>
                                <th class="text-center align-middle">Defaulted</th>
                                <th class="text-center align-middle">Died</th>
                                <th class="text-center align-middle">Admitted</th>
                                <th class="text-center align-middle">Cured</th>
                                <th class="text-center align-middle">Defaulted</th>
                                <th class="text-center align-middle">Died</th>
                            </tr>
                        </thead>
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

</style>
