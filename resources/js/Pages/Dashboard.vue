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
                Dashboard
            </h2>
        </template>
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div 
                            class="m-6 font-semibold text-xl text-gray-800"
                            @click="openSearch"
                        >
                            <font-awesome-icon icon="fa-solid fa-filter"></font-awesome-icon>
                        </div>
                        <div 
                            class="m-2"
                            v-show="search.status"
                        >
                            <input type="text" name="term" id="search" v-model.lazy.trim="term">
                            <button 
                                type="button" 
                                class="bg-indigo-600 text-white text-sm leading-6 font-medium py-2 px-3 rounded-lg"
                                @click="loadData(); closeSearch();"
                            >
                                Search
                            </button>
                        </div>
                        <div
                            v-for="teacher in teachers"
                            :key="teacher.id"
                        >
                            <Link :href="route('teacher-profile', {id: teacher.id})">
                                <div class="max-w-sm w-10/12 lg:max-w-full lg:flex m-3">
                                    <div 
                                        class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" 
                                        :style="{ backgroundImage: 'url(' + teacher.avatar + ')'}" title="teacher.fname + ' ' + teacher.lname avatar"
                                    >
                                    </div>
                                    <div 
                                        class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal"
                                    >
                                    <div class="mb-8">
                                        <div class="text-gray-900 font-bold text-xl mb-2">{{ teacher.fname }} {{ teacher.lname }}</div>
                                        <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>
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
