<script setup>
defineProps({
  routeName: String,
  label: String
  })
</script>

<template>
  <Link :href="route(routeName)" class="text-sm/6 font-semibold text-indigo-600 hover:text-indigo-500 ">
    {{ label }}
  </Link>
</template>