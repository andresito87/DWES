<script setup>
defineProps({ talleres: Object });
</script>

<template>
    <Layout>
        <Head title="Welcome" />
        <h1>Talleres</h1>
        <ul>
            <li v-for="taller in talleres" :key="taller.id">
                {{ taller.nombre }}
            </li>
        </ul>
    </Layout>
</template>
