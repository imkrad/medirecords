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
                                                        <img :src="appointment.patient.avatar" alt="" class="avatar-md rounded-circle">
                                                    </div>
                                                </div>
                                            </BCol>
                                            <BCol md>
                                                <div>
                                                    <h4 class="fw-bold">{{ appointment.patient.member.lastname }}, {{ appointment.patient.member.firstname }} {{ appointment.patient.member.middlename }}. </h4>
                                                    <div class="hstack gap-3 flex-wrap">
                                                        <div><i class="ri-qr-code-fill align-bottom me-1"></i> {{appointment.patient.code}}</div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Marital :</span> <span class="fw-medium">{{appointment.patient.member.status}}</span></div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Sex :</span> <span class="fw-medium">{{appointment.patient.member.sex}}</span></div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Cellphone :</span> <span class="fw-medium">{{appointment.patient.cellphone}}</span></div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Email :</span> <span class="fw-medium">{{appointment.patient.email}}</span></div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Address :</span> <span class="fw-medium">{{appointment.patient.address}}</span></div>
                                                    </div>
                                                </div>
                                            </BCol>
                                        </BRow>
                                    </BCol>
                                    <BCol md="auto mt-3">
                                        <div class="hstack gap-1 flex-wrap">
                                            <button v-if="appointment.status.id != 35" @click="openView(list)" type="button" class="btn btn-primary">
                                                Mark as Completed
                                            </button>
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
                <Family :a="a" :appointment="appointment" :dropdowns="dropdowns.families" v-if="appointment.service_id == 9"/>
                <Maternal :a="a" :appointment="appointment" :dropdowns="dropdowns.maternals" v-if="appointment.service_id == 8"/>
                <Immunization :a="a" :appointment="appointment" :dropdowns="dropdowns.maternals" v-if="appointment.service_id == 7"/>
            </BRow>
        </div>
    </div>
    <Status ref="status"/>
</template>
<script>
import Status from './Modals/Status.vue';
import Family from './Pages/Family.vue';
import Maternal from './Pages/Maternal.vue';
import Immunization from './Pages/Immunization.vue';
export default {
    components: { Family, Maternal, Status, Immunization },
    props:['a','dropdowns'],
    data(){
        return {
            currentUrl: window.location.origin,
            appointment: this.a.data
        }
    },
    methods: {
        openView(){
            this.$refs.status.show(this.a.data);
        },
        back(){
            this.$inertia.visit('/appointments');
        }
    }
}
</script>