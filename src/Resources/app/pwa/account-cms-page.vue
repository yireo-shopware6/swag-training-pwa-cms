<template>
  <div>
    <h3>Example CMS Page Content</h3>
    <CmsPage :content="cmsPage" />
  </div>
</template>

<script>
import { useSessionContext } from "@shopware-pwa/composables"
import { getApplicationContext } from "@shopware-pwa/composables"
import { invokeGet } from "@shopware-pwa/shopware-6-client"
import { defineComponent, watch, onMounted, ref } from "@vue/composition-api"
import CmsPage from "sw-cms/CmsPage"

const loadCmsPage = (root, sessionContext, cmsPage) => {
  const cmsPageId =
    sessionContext.value.extensions.swagTrainingPwaCmsConfig.cmsPageUuid
  try {
    const { apiInstance } = getApplicationContext(root, "SwagExample")

    invokeGet({ address: "/store-api/cms/" + cmsPageId }, apiInstance).then(
      (response) => {
        if (response.data) {
          cmsPage.value = response.data
          console.log(cmsPage)
        }
      }
    )
  } catch (error) {
    console.error("SwagExample:onMounted", error)
  }
}

export default defineComponent({
  components: { CmsPage },
  setup(props, { root }) {
    const { sessionContext } = useSessionContext()
    const cmsPage = ref({})

    onMounted(async () => {
      if (sessionContext.value) {
        loadCmsPage(root, sessionContext, cmsPage)
      }
    })

    watch(sessionContext, (root, cmsPage) => {
      loadCmsPage(root, sessionContext, cmsPage)
    })

    return {
      cmsPage,
    }
  },
})
</script>
