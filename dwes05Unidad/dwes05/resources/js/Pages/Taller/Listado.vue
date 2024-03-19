<script setup>
import Layout from "@/Layouts/TallerLayout.vue";
defineProps({ talleres: Array }, { page: Object });
</script>

<template>
    <Layout>
        <h1>Talleres</h1>
        <ul>
            <li v-for="taller in talleres" :key="taller.id">
                <a :href="`/talleres/${taller.id}`">{{ taller.nombre }}</a>
            </li>
        </ul>
    </Layout>
</template>
