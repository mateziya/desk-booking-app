<script setup>
defineProps({
  links: Array
});
</script>

<template>
  <div v-if="links.length > 0">
    <div class="flex flex-wrap -mb-1 justify-end">
      <template v-for="(link, linkIndex) in links" :key="(linkIndex)">
        <div v-if="link.url === null" class="inline-flex items-center gap-1 px-3 pt-3 text-sm font-semibold text-gray-600" v-html="link.label">
        </div> 
        <Link v-else :href="link.url" class="inline-flex items-center gap-1 px-3 pt-5 pb-2 text-sm font-bold text-gray-500 hover:text-indigo-600" :class="{'text-indigo-600' : link.active}" v-html="link.label"> 
        </Link>
      </template>
    </div>
  </div>
</template>