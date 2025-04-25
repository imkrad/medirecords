<template>
    <Head title="Patient Profile" />
    <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
        <div class="w-100 p-4 pb-0" ref="box">
            <BRow>
                <BCol lg="12">
                    <BCard no-body class="mt-n4 mx-n4">
                        <div class="bg-success-subtle">
                            <BCardBody class="pb-0 px-4">
                                <BRow class="mb-3">
                                    <BCol md>
                                        <BRow class="align-items-center g-3">
                                            <BCol md="auto">
                                                <div class="avatar-md">
                                                    <div class="avatar-title bg-white rounded-circle">
                                                        <img :src="patient.avatar" alt="" class="avatar-md rounded-circle">
                                                    </div>
                                                </div>
                                            </BCol>
                                            <BCol md>
                                                <div>
                                                    <h4 class="fw-bold">{{ patient.lastname }}, {{ patient.firstname }} {{ patient.middlename }}. </h4>
                                                    <div class="hstack gap-3 flex-wrap">
                                                        <div><i class="ri-qr-code-fill align-bottom me-1"></i> {{patient.code}}</div>
                                                      
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Address :</span> <span class="fw-medium">{{patient.address}}</span></div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Marital :</span> <span class="fw-medium">{{patient.status}}</span></div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Sex :</span> <span class="fw-medium">{{patient.sex}}</span></div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Cellphone :</span> <span class="fw-medium">{{patient.cellphone}}</span></div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Email :</span> <span class="fw-medium">{{patient.email}}</span></div>
                                                        <div class="vr"></div>
                                                    </div>
                                                </div>
                                            </BCol>
                                        </BRow>
                                    </BCol>
                                    <BCol md="auto">
                                        <div class="hstack gap-1 flex-wrap">
                                            <button @click="back()" type="button" class="btn py-0 fs-16 text-body">
                                                <i class="ri-share-line"></i>
                                            </button>
                                        </div>
                                    </BCol>
                                </BRow>
                            </BCardBody>
                        </div>
                    </BCard>
                </BCol>
                <BCol lg="12">
                    <div class="card">
                        <div class="card-body" style="height: calc(100vh - 290px);">
                            <BTabs nav-class="nav-pills nav-custom nav-custom-light" pills>
                                <BTab title="Appointments">
                                    <table class="table align-middle table-centered mb-0 mt-3">
                                        <thead class="table-primary thead-fixed">
                                            <tr class="fs-11">
                                                <th style="width: 3%;"></th>
                                                <th>Service</th>
                                                <th style="width: 20%;" class="text-center">Age</th>
                                                <th style="width: 20%;" class="text-center">Status</th>
                                                <th style="width: 20%;" class="text-center">Registration Date</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-white">
                                            <tr v-for="(list,index) in appointments" v-bind:key="index" >
                                                <td class="text-center">{{ index+1 }}</td>
                                                <td>
                                                    <h5 class="fs-13 mb-0 fw-semibold text-primary text-uppercase">{{list.service.name}}</h5>
                                                </td>
                                                <td class="text-center">{{ list.age }}</td>
                                                <td class="text-center">{{ list.status.name }}</td>
                                                <td class="text-center">{{ list.registration_at }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </BTab>
                                <BTab title="Maternal Checkups">
                                    <table class="table align-middle table-centered mb-0 mt-3">
                                        <thead class="table-primary thead-fixed">
                                            <tr class="fs-11">
                                                <th style="width: 3%;"></th>
                                                <th>Type</th>
                                                <th style="width: 25%;" class="text-center">Subtype</th>
                                                <th style="width: 15%;" class="text-center">Count</th>
                                                <th style="width: 15%;" class="text-center">Value</th>
                                                <th style="width: 25%;" class="text-center">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-white">
                                            <tr v-for="(list,index) in maternalcheckups" v-bind:key="index" >
                                                <td class="text-center">{{ index+1 }}</td>
                                                <td>
                                                    <h5 class="fs-13 mb-0 fw-semibold text-primary text-uppercase">{{list.type.name}}</h5>
                                                </td>
                                                <td class="text-center">{{ list.subtype.name }}</td>
                                                <td class="text-center">{{ list.count }}</td>
                                                <td class="text-center">{{ (list.value) ? list.value : '-' }}</td>
                                                <td class="text-center">{{ list.date_at }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </BTab>
                                <BTab title="Immunizations">
                                    <table class="table align-middle table-centered mb-0 mt-3">
                                        <thead class="table-primary thead-fixed">
                                            <tr class="fs-11">
                                                <th style="width: 3%;"></th>
                                                <th>Vaccine</th>
                                                <th style="width: 15%;" class="text-center">Short</th>
                                                <th style="width: 15%;" class="text-center">Range</th>
                                                <th style="width: 20%;" class="text-center">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-white">
                                            <tr v-for="(list,index) in immunizations" v-bind:key="index" >
                                                <td class="text-center">{{ index+1 }}</td>
                                                <td>
                                                    <h5 class="fs-13 mb-0 fw-semibold text-primary text-uppercase">{{list.vaccine.vaccine.name}}</h5>
                                                </td>
                                                <td class="text-center">{{ list.vaccine.vaccine.short }}</td>
                                                <td class="text-center">{{ list.range.name }}</td>
                                                <td class="text-center">{{ list.date_at }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </BTab>
                                <BTab title="Family Visits">
                                    <table class="table align-middle table-centered mb-0 mt-3">
                                        <thead class="table-primary thead-fixed">
                                            <tr class="fs-11">
                                                <th style="width: 3%;"></th>
                                                <th>Visited Date</th>
                                                <th style="width: 15%;" class="text-center">Blood Pressure</th>
                                                <th style="width: 15%;" class="text-center">Pulse Rate</th>
                                                <th style="width: 15%;" class="text-center">Tempperature</th>
                                                <th style="width: 20%;" class="text-center">Scheduled Date</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-white">
                                            <tr v-for="(list,index) in familyvisits" v-bind:key="index" >
                                                <td class="text-center">{{ index+1 }}</td>
                                                <td>
                                                    <h5 class="fs-13 mb-0 fw-semibold text-primary text-uppercase">{{list.visited_at}}</h5>
                                                </td>
                                                <td class="text-center">{{ list.bloodpressure }}</td>
                                                <td class="text-center">{{ list.pulserate }}</td>
                                                <td class="text-center">{{ list.temperature }}</td>
                                                <td class="text-center">{{ list.scheduled_at }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </BTab>
                                <BTab title="Family Checkups">
                                    <table class="table align-middle table-centered mb-0 mt-3">
                                        <thead class="table-primary thead-fixed">
                                            <tr class="fs-11">
                                                <th style="width: 3%;"></th>
                                                <th>Type</th>
                                                <th style="width: 15%;" class="text-center">Count</th>
                                                <th style="width: 20%;" class="text-center">Given Date</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-white">
                                            <tr v-for="(list,index) in familycheckups" v-bind:key="index" >
                                                <td class="text-center">{{ index+1 }}</td>
                                                <td>
                                                    <h5 class="fs-13 mb-0 fw-semibold text-primary text-uppercase">{{list.type.name}}</h5>
                                                </td>
                                                <td class="text-center">{{ list.count }}</td>
                                                <td class="text-center">{{ list.date_at }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </BTab>
                                
                                <BTab title="Family Member">
                                    <table class="table align-middle table-centered mb-0 mt-3">
                                        <thead class="table-primary thead-fixed">
                                            <tr class="fs-11">
                                                <th style="width: 3%;"></th>
                                                <th>Name</th>
                                                <th style="width: 10%;" class="text-center">Type</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-white">
                                            <tr v-for="(list,index) in patient.families[0].members" v-bind:key="index" >
                                                <td class="text-center">{{ index+1 }}</td>
                                                <td>
                                                    <h5 class="fs-13 mb-0 fw-semibold text-primary text-uppercase">{{list.name}}</h5>
                                                </td>
                                                <td class="text-center">{{ list.type }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </BTab>
                            </BTabs>
                        </div>
                    </div>
                </BCol>
            </BRow>
        </div>
    </div>
</template>
<script>
export default {
    props:['p','appointments','familyvisits','familycheckups','maternalcheckups','immunizations'],
    data(){
        return {
            currentUrl: window.location.origin,
            patient: this.p.data
        }
    },
    methods: {
        back(){
            this.$inertia.visit('/patients');
        }
    }
}
</script>