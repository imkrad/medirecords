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
                                                        <div class="vr"></div>
                                                    </div>
                                                </div>
                                            </BCol>
                                        </BRow>
                                    </BCol>
                                    <BCol md="auto">
                                        <div class="hstack gap-1 flex-wrap">
                                            <button @click="openName()" type="button" v-b-tooltip.hover title="Add name" class="btn py-0 fs-16 text-body me-n3">
                                                <i class="ri-add-circle-fill"></i>
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
            </BRow>
        </div>
    </div>
</template>
<script>
export default {
    props:['p'],
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