<template>
    <!-- Main modal -->
    <div id="editCompany" class="bg-bgModal fixed top-0 flex items-center justify-center left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 
             md:h-full h-full sm:h-full">
        <div class="relative w-full h-auto max-w-4xl md:h-auto">
            <!-- Modal content -->
            <div class="relative rounded-lg shadow bg-body">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 rounded-t">
                    <h3 class="text-xl font-semibold text-gray-300">
                        {{ trans('lang.labels.edit_business') }} <span></span>
                    </h3>
                    <button type="button" @click="isCloseEditModal()" class="">
                        <XCircleIcon class="h-9 w-9 text-white" aria-hidden="true" />
                    </button>
                </div>
                <!-- Form start here -->
                    <div class="p-6 space-y-6 h-96 sm:h-96 lg:h-96 overflow-y-auto theme-modal-body">
                        <div class="mb-3">
                            <div class="w-full">
                                <div
                                    class="theme-upload-img block sm:flex md:flex  items-center justify-between border-2 border-gray-500 border-dashed rounded-lg cursor-pointer bg-sidebar">
                                    <label for="dropzone-file" class="w-full h-64">
                                        <div class="flex flex-col h-full items-center justify-center pt-5 pb-6">
                                            <div>
                                                <div>
                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                        <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                            </path>
                                                        </svg>
                                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                                            <span class="font-semibold">Click to upload</span>
                                                            or drag and drop
                                                        </p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                                            SVG, PNG, JPG or GIF (MAX. 800x400px)
                                                        </p>

                                                        <input id="dropzone-file" type="file" class="hidden"
                                                            @change="previewImage"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <template v-if="form.logo && form.logo != '' || preview != null">
                                        <div
                                            class="flex flex-col items-center justify-center w-full xs:w-28 sm:w-30 h-64 p-5">
                                            <div
                                                class="flex flex-col items-center justify-center pt-5 pb-6 w-full xs:w-28 sm:w-30">
                                                <img :src="preview != null ? preview : (mediaPath + '/' + form.logo)"
                                                        alt="logo" class="h-56 object-cover w-full rounded-lg" />
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-3">
                            <div class="relative">
                                <input type="text" id="business_name"
                                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-neutral-100 bg-sidebar rounded-lg border-1 border-transparent appearance-none
                                                                            dark:focus:border-amber-500 focus:outline-none focus:ring-0 focus:border-amber-500 peer"
                                    placeholder=" " v-model="form.name" />
                                <label for="business_name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75
                                                                            top-2 z-10 origin-[0] bg-sidebar px-2 peer-focus:px-2 peer-focus:text-amber-500 peer-focus:dark:text-amber-500
                                                                            peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                                                            peer-focus:-translate-y-4 left-1">
                                    {{ trans('lang.labels.address_name') }}
                                </label>
                                <span v-if="errors.name" class="mt-2 text-sm text-red-600 theme-error-message">{{
                                    errors.name[0]
                                }}</span>
                            </div>
                            <div class="relative">
                                <input type="text" id="abn_name"
                                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-neutral-100 bg-sidebar rounded-lg border-1 border-transparent appearance-none
                                                                            dark:focus:border-amber-500 focus:outline-none focus:ring-0 focus:border-amber-500 peer"
                                    placeholder=" " v-model="form.abn" />
                                <label for="abn_name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75
                                                                            top-2 z-10 origin-[0] bg-sidebar px-2 peer-focus:px-2 peer-focus:text-amber-500 peer-focus:dark:text-amber-500
                                                                            peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                                                            peer-focus:-translate-y-4 left-1">
                                    {{ trans('lang.labels.abn') }}
                                </label>
                                <span v-if="errors.abn" class="mt-2 text-sm text-red-600 theme-error-message">{{
                                    errors.abn[0]
                                }}</span>
                            </div>
                        </div>
                        <div class="">
                            <div class="mt-3 mb-4">
                                <span class="text-lg font-extrabold text-neutral-300">{{ trans('lang.labels.address') }}</span>
                            </div>
                            <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-3">
                                <div class="relative">
                                    <input type="text" id="street_name"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-neutral-100 bg-sidebar rounded-lg border-1 border-transparent appearance-none
                                                                            dark:focus:border-amber-500 focus:outline-none focus:ring-0 focus:border-amber-500 peer"
                                        placeholder=" " v-model="form.street" />
                                    <label for="street_name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75
                                                                            top-2 z-10 origin-[0] bg-sidebar px-2 peer-focus:px-2 peer-focus:text-amber-500 peer-focus:dark:text-amber-500
                                                                            peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                                                            peer-focus:-translate-y-4 left-1">
                                        {{ trans('lang.labels.street') }}
                                    </label>
                                    <span v-if="errors.street" class="mt-2 text-sm text-red-600 theme-error-message">{{
                                        errors.street[0]
                                    }}</span>
                                </div>
                                <div class="relative">
                                    <input type="text" id="city_name"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-neutral-100 bg-sidebar rounded-lg border-1 border-transparent appearance-none
                                                                            dark:focus:border-amber-500 focus:outline-none focus:ring-0 focus:border-amber-500 peer"
                                        placeholder=" " v-model="form.city" />
                                    <label for="city_name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75
                                                                            top-2 z-10 origin-[0] bg-sidebar px-2 peer-focus:px-2 peer-focus:text-amber-500 peer-focus:dark:text-amber-500
                                                                            peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                                                            peer-focus:-translate-y-4 left-1">
                                        {{ trans('lang.labels.city') }}
                                    </label>
                                    <span v-if="errors.city" class="mt-2 text-sm text-red-600 theme-error-message">{{
                                        errors.city[0]
                                    }}</span>
                                </div>
                                <div class="relative">
                                    <input type="text" id="state_name"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-neutral-100 bg-sidebar rounded-lg border-1 border-transparent appearance-none dark:focus:border-amber-500 focus:outline-none focus:ring-0 focus:border-amber-500 peer"
                                        placeholder=" " v-model="form.state" />
                                    <label for="state_name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-sidebar px-2 peer-focus:px-2 peer-focus:text-amber-500 peer-focus:dark:text-amber-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                        {{ trans('lang.labels.state') }}
                                    </label>
                                    <span v-if="errors.state" class="mt-2 text-sm text-red-600 theme-error-message">{{
                                        errors.state[0]
                                    }}</span>
                                </div>
                                <div class="relative">
                                    <input type="text" id="postcode_name"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-neutral-100 bg-sidebar rounded-lg border-1 border-transparent appearance-none
                                                                            dark:focus:border-amber-500 focus:outline-none focus:ring-0 focus:border-amber-500 peer"
                                        placeholder=" " v-model="form.postcode" />
                                    <label for="postcode_name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75
                                                                            top-2 z-10 origin-[0] bg-sidebar px-2 peer-focus:px-2 peer-focus:text-amber-500 peer-focus:dark:text-amber-500
                                                                            peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                                                            peer-focus:-translate-y-4 left-1">
                                        {{ trans('lang.labels.postcode') }}
                                    </label>
                                    <span v-if="errors.postcode" class="mt-2 text-sm text-red-600 theme-error-message">{{
                                        errors.postcode[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="mt-3 mb-4">
                                <span class="text-lg font-extrabold text-neutral-300">Contact</span>
                            </div>
                            <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-3">
                                <div class="relative">
                                    <input type="text" id="website_name"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-neutral-100 bg-sidebar rounded-lg border-1 border-transparent appearance-none
                                                                            dark:focus:border-amber-500 focus:outline-none focus:ring-0 focus:border-amber-500 peer"
                                        placeholder=" " v-model="form.website" />
                                    <label for="website_name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75
                                                                            top-2 z-10 origin-[0] bg-sidebar px-2 peer-focus:px-2 peer-focus:text-amber-500 peer-focus:dark:text-amber-500
                                                                            peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                                                            peer-focus:-translate-y-4 left-1">
                                        {{ trans('lang.labels.website') }}
                                    </label>
                                    <span v-if="errors.website" class="mt-2 text-sm text-red-600 theme-error-message">{{
                                        errors.website[0]
                                    }}</span>


                                </div>
                                <div class="relative">
                                    <input type="text" id="phone_name"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-neutral-100 bg-sidebar rounded-lg border-1 border-transparent appearance-none
                                                                            dark:focus:border-amber-500 focus:outline-none focus:ring-0 focus:border-amber-500 peer"
                                        placeholder=" " v-model="form.phone_nr" />
                                    <label for="phone_name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75
                                                                            top-2 z-10 origin-[0] bg-sidebar px-2 peer-focus:px-2 peer-focus:text-amber-500 peer-focus:dark:text-amber-500
                                                                            peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                                                            peer-focus:-translate-y-4 left-1">
                                        {{ trans('lang.labels.phone_number') }}
                                    </label>
                                    <span v-if="errors.phone_nr" class="mt-2 text-sm text-red-600 theme-error-message">{{ errors.phone_nr[0] }}</span>

                                </div>
                                <div class="relative">
                                    <input type="text" id="email_name"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-neutral-100 bg-sidebar rounded-lg border-1 border-transparent appearance-none
                                                                            dark:focus:border-amber-500 focus:outline-none focus:ring-0 focus:border-amber-500 peer"
                                        placeholder=" " v-model="form.email" />
                                    <label for="email_name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75
                                                                            top-2 z-10 origin-[0] bg-sidebar px-2 peer-focus:px-2 peer-focus:text-amber-500 peer-focus:dark:text-amber-500
                                                                            peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                                                            peer-focus:-translate-y-4 left-1">
                                        {{ trans('lang.labels.email') }}
                                    </label>
                                    <span v-if="errors.email" class="mt-2 text-sm text-red-600 theme-error-message">{{
                                        errors.email[0]
                                    }}</span>
                                </div>
                                <div class="relative">
                                    <input type="text" id="years_name"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-neutral-100 bg-sidebar rounded-lg border-1 border-transparent appearance-none
                                                                            dark:focus:border-amber-500 focus:outline-none focus:ring-0 focus:border-amber-500 peer"
                                        placeholder=" " v-model="form.years_trading" />
                                    <label for="years_name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75
                                                                            top-2 z-10 origin-[0] bg-sidebar px-2 peer-focus:px-2 peer-focus:text-amber-500 peer-focus:dark:text-amber-500
                                                                            peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                                                            peer-focus:-translate-y-4 left-1">
                                        {{ trans('lang.labels.years_trading') }}
                                    </label>
                                    <span v-if="errors.years_trading"
                                        class="mt-2 text-sm text-red-600 theme-error-message">{{
                                            errors.years_trading[0]
                                        }}</span>

                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-6 space-x-2 rounded-b dark:border-gray-600">
                        <button @click="isCloseEditModal()"
                            class="text-btnCancelText bg-btnCancelBg font-medium rounded-lg text-sm px-5 py-2.5 text-center">{{ trans('lang.modal.cancel') }}</button>
                        <button :disabled="formProcess" @click="submitForm()"
                            class="text-btnSubmitText bg-btnSubmitBg rounded-lg text-sm font-medium px-5 py-2.5">{{ trans('lang.modal.update') }}</button>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { mapStores } from 'pinia'
import { useAppStore } from "@/store";
import {
    TrashIcon, XCircleIcon
} from '@heroicons/vue/24/solid'
export default {
    name: 'EditCompany',
    components: {
        TrashIcon, XCircleIcon
    },
    props: ['data'],
    data() {
        return {
            form: {
            },
            formProcess: false,
            errors: {
                name: '',
                phone_nr: '',
                file: '',
                status: '',
                email: '',
                abn: '',
                street: '',
                city: '',
                state: '',
                postcode: '',
                website: '',
                years_trading: ''

            },
            preview: null,
            image: null,
        }
    },
    methods: {
        submitForm() {
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            this.formProcess = true;
            let formData = this.convertJsonToFormData(this.form);
            formData.append("_method", "PUT")
            if (this.image) {
                formData.append('file', this.image);
            }
            axios.post('/api/companies/' + this.data.editItemId, formData, config)
                .then((res) => {
                    if (res.data.status == true) {
                        this.form = {};
                        this.isCloseEditModal();
                        let notification = {
                            heading: 'success',
                            subHeading: res.data.message,
                            type: "success",
                        };
                        this.appStore.setNotification(notification);
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    // error.response.status Check status code

                    //if any error happened remove modal and overflow itself
                    that.isCloseEditModal();
                })
                .finally(() => {
                    this.formProcess = false;
                    //Perform action in always
                });
        },
        editField() {
            let that = this;
            axios
                .get("/api/companies/" + that.data.editItemId)
                .then((res) => {
                    that.form = res.data.data;
                })
                .catch((error) => {
                    that.errors = error.response.data.errors;
                })
                .finally(() => {
                    //Perform action in always
                });
        },
        isCloseEditModal() {
            this.$emit('cancel');
        },
        previewImage: function (event) {
            let input = event.target;
            if (input.files) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.preview = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
                this.image = input.files[0];
            }
        },
        deleteImg() {
            if (this.preview) {
                this.preview = null;
            } else {
                this.form.logo = '';
            }
        },
    },
    created() {
        this.editField();
    },
    computed: {
        ...mapStores(useAppStore),
    },
}
</script>
