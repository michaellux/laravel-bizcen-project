<script setup>
import { Head } from "@inertiajs/vue3";

defineProps({ title: String });
</script>

<template>
  <Head
    :title="title ? `${title} - Bizcen test project` : 'Bizcen test project'"
  >
    <slot />
  </Head>
</template>
