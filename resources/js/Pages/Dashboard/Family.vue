<template lang="">
    <Head title="Technical Service Requests"/>
    <div class="auth-page-wrapper d-flex min-vh-100">
        <div class="auth-page-content">
            <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
                <div class="file-manager-content w-100 p-4 pb-0" ref="box">
                        <table class="table table-bordered table-nowrap align-middle">
                            <thead class="bg-primary text-white">
                                <tr class="fs-10">
                                    <th class="text-center align-middle" rowspan="2" style="width: 120px;">Registration</th>
                                    <th class="text-center align-middle" rowspan="2" style="width: 180px;">Fullname</th>
                                    <th class="text-center align-middle" rowspan="2" style="width: 150px;">Client Type</th>
                                    <th class="text-center align-middle" rowspan="2" style="width: 150px;">Method</th>
                                    <th class="text-center" colspan="12">Follow-up Visits</th>
                                    <th class="text-center" colspan="3">Deworming Drugs Given to 20-40 yrs old</th>
                                    <th class="text-center align-middle" rowspan="2">Drop-out</th>
                                </tr>
                                <tr class="fs-10">
                                    <th class="text-center align-middle" v-for="(list,index) in months" v-bind:key="index">{{list.name}}</th>
                                    <th class="text-center align-middle">Jan</th>
                                    <th class="text-center align-middle">Feb</th>
                                    <th class="text-center align-middle">Mar</th>
                                    <th class="text-center align-middle">Apr</th>
                                    <th class="text-center align-middle">May</th>
                                    <th class="text-center align-middle">Jun</th>
                                    <th class="text-center align-middle">Jul</th>
                                    <th class="text-center align-middle">Aug</th>
                                    <th class="text-center align-middle">Sep</th>
                                    <th class="text-center align-middle">Oct</th>
                                    <th class="text-center align-middle">Nov</th>
                                    <th class="text-center align-middle">Dec</th>
                                    <th class="text-center align-middle">1st dose given</th>
                                    <th class="text-center align-middle">2nd dose given</th>
                                    <th class="text-center align-middle">3rd dose given</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr>
                                    <td class="text-center" v-for="(list,index) in results" v-bind:key="index" :style="index > 12 ? 'cursor: pointer;' : ''" @click="handleClick(index, list)">
                                        <i v-if="list" class="text-success fs-16 ri-checkbox-circle-fill"></i>
                                        <i v-else class="text-danger fs-16 ri-close-circle-line"></i>
                                    </td>
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
