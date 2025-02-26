<template>
    <Head title="Users" />
    <PageHeader title="Create Patient" pageTitle="Lists" />
    <div class="row justify-content-center">
    <div class="col-xxl-12">
        <div class="card" v-if="form.has_familynumber != null">
            <form class="needs-validation" novalidate="">
                <div class="card-header"><h5 class="card-title mb-0">Patient Profile</h5></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <div class="profile-user position-relative d-inline-block mx-auto mb-3">
                                            <img :src="$page.props.user.data.avatar" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow">
                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <input id="profile-img-file-input" type="file" class="profile-img-file-input" @change="previewImage"/>
                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                    <i class="ri-camera-fill"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <h5 class="fs-16 mb-1">Test Name</h5>
                                        <p class="text-muted mb-0">Heheheh</p>
                                    </div>
                                </div>
                                <div class="col-md-9" style="height: calc(100vh - 400px); overflow: auto;">
                                    <!-- <div>
                                        <label for="billingName" class="text-muted text-uppercase fw-semibold">Personal Information</label>
                                    </div> -->
                                    <div class="row g-2">
                                        <div class="col-md-12">
                                            <div>
                                                <label for="billingName" class="text-muted text-uppercase fw-semibold">Family No.</label>
                                            </div>
                                            <hr class="text-muted mt-1 mb-0"/>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Family Number</label>
                                            <input type="text" v-model="form.code" class="form-control bg-light border-0" placeholder="System generated code" readonly>
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md-12">
                                            <hr class="text-muted mt-3 mb-3"/>
                                            <div>
                                                <label for="billingName" class="text-muted text-uppercase fw-semibold">Personal Information</label>
                                            </div>
                                            <hr class="text-muted mt-1 mb-0"/>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">First Name</label>
                                            <input type="text" v-model="form.firstname" class="form-control bg-light border-0" placeholder="Please enter first name">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Middle Name</label>
                                            <input type="text" v-model="form.middlename" class="form-control bg-light border-0" placeholder="Please enter middle name">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" v-model="form.lastname" class="form-control bg-light border-0" placeholder="Please enter last name">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Date of Birth</label>
                                            <input type="date" v-model="form.birthdate" class="form-control bg-light border-0" placeholder="Please enter date of birth">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Sex</label>
                                            <Multiselect :options="['Male','Female']" label="name" v-model="form.sex" :message="form.errors.sex" placeholder="Select Sex" ref="multiselect1"/>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Marital Status</label>
                                            <!-- <input type="text" v-model="form.status" class="form-control bg-light border-0" placeholder="Please enter email"> -->
                                            <Multiselect :options="['Single','Married','Divorced','Separated','Widowed']" label="name" v-model="form.status" :message="form.errors.status" placeholder="Select Status" ref="multiselect1"/>
                                        </div>
                                    </div>
                                    <div class="row g-4" v-if="form.status != null && form.sex != null && form.code == null">
                                        <div class="col-md-12">
                                            <hr class="text-muted mt-3 mb-3"/>
                                            <div>
                                                <label for="billingName" class="text-muted text-uppercase fw-semibold">Family Background</label>
                                            </div>
                                            <hr class="text-muted mt-1 mb-0"/>
                                        </div>
                                        <div class="col-md-6 mt-2" v-if="form.status == 'Single'">
                                            <div class="row g-2 border rounded p-2 mt-2">
                                                <div class="col-md-12">
                                                    <p class="text-primary fw-semibold mb-0">Mother Name</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">First Name</label>
                                                    <input type="text" v-model="form.mother.firstname" class="form-control bg-light border-0" placeholder="Please enter last name">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Middle Name</label>
                                                    <input type="text" v-model="form.mother.middlename" class="form-control bg-light border-0" placeholder="Please enter last name">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Last Name</label>
                                                    <input type="text" v-model="form.mother.lastname" class="form-control bg-light border-0" placeholder="Please enter last name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2" v-if="form.status == 'Single'">
                                            <div class="row g-2 border rounded p-2 mt-2">
                                                <div class="col-md-12">
                                                    <p class="text-primary fw-semibold mb-0">Father Name</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">First Name</label>
                                                    <input type="text" v-model="form.father.firstname" class="form-control bg-light border-0" placeholder="Please enter last name">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Middle Name</label>
                                                    <input type="text" v-model="form.father.middlename" class="form-control bg-light border-0" placeholder="Please enter last name">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Last Name</label>
                                                    <input type="text" v-model="form.father.lastname" class="form-control bg-light border-0" placeholder="Please enter last name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" v-if="form.status != 'Single'">
                                            <div class="row g-2 border rounded p-2 mt-n1">
                                                <div class="col-md-12">
                                                    <p class="text-primary fw-semibold mb-0">Spouse</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">First Name</label>
                                                    <input type="text" v-model="form.mother.firstname" class="form-control bg-light border-0" placeholder="Please enter last name">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Middle Name</label>
                                                    <input type="text" v-model="form.mother.middlename" class="form-control bg-light border-0" placeholder="Please enter last name">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Last Name</label>
                                                    <input type="text" v-model="form.mother.lastname" class="form-control bg-light border-0" placeholder="Please enter last name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md-12">
                                            <hr class="text-muted mt-3 mb-3"/>
                                            <div>
                                                <label for="billingName" class="text-muted text-uppercase fw-semibold">Contact Information</label>
                                            </div>
                                            <hr class="text-muted mt-1 mb-0"/>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Email</label>
                                            <input type="text" v-model="form.email" class="form-control bg-light border-0" placeholder="Please enter email">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Home Phone</label>
                                            <input type="text" v-model="form.homephone" class="form-control bg-light border-0" placeholder="Please enter home phone no.">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Cell Phone</label>
                                            <input type="text" v-model="form.cellphone" class="form-control bg-light border-0" placeholder="Please enter cell phone no.">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Address</label>
                                            <input type="text" v-model="form.address" class="form-control bg-light border-0" placeholder="Please enter street address">
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md-12">
                                            <hr class="text-muted mt-3 mb-3"/>
                                            <div>
                                                <label for="billingName" class="text-muted text-uppercase fw-semibold">Emergency Contact Information</label>
                                            </div>
                                            <hr class="text-muted mt-1 mb-0"/>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" v-model="form.fullname" class="form-control bg-light border-0" placeholder="Please enter full name">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Cell Phone</label>
                                            <input type="text" v-model="form.contact_no" class="form-control bg-light border-0" placeholder="Please enter cell phone no.">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Relationship</label>
                                            <Multiselect :options="['Spouse','Mother','Father','Sibling', 'Others']" label="name" v-model="form.relationship" :message="form.errors.relationship" :appendToBody="true"  placeholder="Select Relationship" ref="multiselect1"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 mt-n4">
                    <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                        <button @click="submit('ok')" class="btn btn-success btn-md" type="button">
                            <div class="btn-content">
                                <i class="ri-user-add-fill align-bottom me-1"></i> Create Patient
                            </div>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div v-else class="d-flex justify-content-center align-items-center" style="height: calc(100vh - 350px);">
            <div class="col-md-6 text-center border border-dashed p-4 rounded bg-light-subtle mt-n4">
                <h5 class="text-primary fs-20 mt-2">Find Family Number</h5>
                <p class="text-muted fs-13">
                    If single, please search using your mother’s or father’s name. <br /> If married, you may also search using your own name or your spouse’s name.
                </p>
                <p class="text-danger fw-semibold fs-13 mb-4">This is to group a family under a single family number.</p>
                <b-button @click="openSearch" variant="primary" class="btn-label waves-effect waves-light"><i class="ri-search-eye-line label-icon align-middle fs-16 me-2"></i>Search Record</b-button>
            </div>
        </div>
    </div>
</div>
<Search @submitForm="submitData" ref="search"/>
</template>
<script>
import { useForm } from "@inertiajs/vue3";
import Multiselect from "@vueform/multiselect";
import Search from './Search.vue';
import PageHeader from '@/Shared/Components/PageHeader.vue';
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { Pagination, PageHeader, Multiselect, Search }, 
    props: ['statuses'],
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                has_familynumber: null,
                code: null,
                firstname: null,
                middlename: null,
                lastname: null,
                sex: null,
                birthdate: null,
                status: null,
                email: null,
                cellphone: null,
                homephone: null,
                address: null,
                fullname: null,
                contact_no: null,
                relationship: null,
                mother: {
                    firstname : null,
                    middlename : null,
                    lastname : null,
                    sex: 'Female',
                    status: 'Married'
                },
                father: {
                    firstname : null,
                    middlename : null,
                    lastname : null,
                    sex: 'Male',
                    status: 'Married'
                },
                spouse: {
                    firstname : null,
                    middlename : null,
                    lastname : null,
                    sex: null,
                    status: 'Married'
                },
                image: null,
            }),
        }
    },
   methods: {
        previewImage(e) {
            var fileInput = document.querySelector(".profile-img-file-input");
            var preview = document.querySelector(".user-profile-image");
            var file = fileInput.files[0];
            this.form.image = file;
            var reader = new FileReader();

            reader.addEventListener("load", () => { 
                preview.src = reader.result;
                // this.form.post('/profile', {
                //     errorBag: 'updateProfileInformation',
                //     preserveScroll: true,
                //     onSuccess: () => '',
                // });
            }, false);

            if (file) { 
                reader.readAsDataURL(file); 
            }
        },
        submit(){
            this.form.post('/patients',{
                preserveScroll: true,
                onSuccess: (response) => {
                    // this.$emit('update',true);
                    // this.hide();
                },
            });
        },
        openSearch(){
            this.$refs.search.show();
        },
        submitData(data) {
            this.form.has_familynumber = data.has_member;
            if(data.has_member === 0){
                this.form.code = null;
            }else if(data.has_member == 1){
                console.log(data);
                this.form.code = data.code;
            }
        }
   }
}
</script>
<style scoped>
.form-label {
    font-size: 12px;
    margin-bottom: 5px;
}
</style>