<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import { ref, onMounted, reactive, computed } from 'vue';

const props = defineProps(['user_id']);
const teachers = ref([]);
const search = reactive({status: false});
const term = ref('');

const dataInit = async () => {
    loadData();
}

function openSearch() {
    search.status = true;
    term.value = '';   
}

function closeSearch() {
    search.status = false;  
}

function loadData() {
    axios.get('/api/teachers', {
        params: {
            school_id: 16,
            user_id: props.user_id,
            search_terms: term.value
        }
    })
    .then((res) => {
        teachers.value = res.data.teachers;
    })
    .catch((error) => {
        console.log(error);
    })
}

onMounted(dataInit)
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <!-- TODO: use once Role model is built -->
               <!-- {{ user.role.name }} Dashboard -->
               Coaches Dashboard
            </h2>
        </template>
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-gray-400 w-12/12">
                            <div class="
                                    min-w-full 
                                    rounded-lg 
                                    flex
                                    justify-end
                                    content-center"
                                >
                                <div 
                                    class="m-6 font-semibold text-xl text-gray-800"
                                    @click="openSearch"
                                >
                                    <font-awesome-icon 
                                        icon="fa-solid fa-filter"
                                        v-if="!search.status"
                                    ></font-awesome-icon>
                                </div>
                                <div 
                                    class="m-6 font-semibold text-xl text-gray-800"
                                    @click="closeSearch"
                                    v-if="search.status"
                                >
                                    <font-awesome-icon icon="fa-solid fa-times"></font-awesome-icon>
                                </div>
                                <div 
                                    class="m-2"
                                    v-show="search.status"
                                >
                                    <form 
                                        @submit.prevent="loadData"
                                        class="flex pt-2"
                                    >
                                        <input type="text" name="term" id="search" v-model.lazy.trim="term">
                                        <button 
                                            type="button" 
                                            class="bg-blue-600 text-white text-sm leading-6 font-medium py-2 px-3 rounded-lg mx-2"
                                            @click="loadData(); closeSearch();"
                                        >
                                            Search
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        
                        <div
                            v-for="teacher in teachers"
                            :key="teacher.id"
                        >
                            <Link :href="route('teacher-profile', {id: teacher.id})">
                                <div class="my-4 max-w-sm w-10/12 lg:max-w-full lg:flex">
                                    <div 
                                        class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" 
                                        :style="{ backgroundImage: 'url(' + teacher.avatar + ')'}" title="teacher.fname + ' ' + teacher.lname avatar"
                                    >
                                    </div>
                                    <div 
                                        class="bg-gray-100 min-w-full border-r border-b border-l border-gray-200 lg:border-l-0 lg:border-t lg:border-gray-200 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal"
                                    >
                                    <div class="mb-8">
                                        <div class="text-gray-900 font-bold text-2xl mb-2">{{ teacher.fname }} {{ teacher.lname }}</div>
                                        <div class="text-lg  font-semibold">PD Notes:</div>
                                        <p class="text-gray-700 text-base">{{ teacher.pd_notes }}</p>
                                    </div>
                                        <div class="flex items-center">
                                            <div class="text-sm">
                                                <p class="text-gray-600">Last Visit: </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
