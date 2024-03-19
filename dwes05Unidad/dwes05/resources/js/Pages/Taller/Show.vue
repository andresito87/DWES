<script setup>
import Layout from "@/Layouts/TallerLayout.vue";
defineProps({ taller: Object });
</script>

<template>
    <Layout>
        <h1>Taller con id {{ taller.id }}</h1>
        <table>
            <tr>
                <th>Nombre</th>
                <td>{{ taller.nombre }}</td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td>{{ taller.descripcion }}</td>
            </tr>
            <tr>
                <th>Hora de Inicio</th>
                <td>{{ taller.hora_inicio }}</td>
            </tr>
            <tr>
                <th>Hora de Fin</th>
                <td>{{ taller.hora_fin }}</td>
            </tr>
            <tr>
                <th>Cupo máximo</th>
                <td>{{ taller.cupo_maximo }}</td>
            </tr>
            <tr>
                <th>Ubicación</th>
                <td>
                    <a :href="`/ubicaciones/${taller.ubicacion.id}`">
                        {{ taller.ubicacion.nombre }}
                    </a>
                </td>
            </tr>
        </table>
    </Layout>
</template>
