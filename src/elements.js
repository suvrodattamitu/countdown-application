import { createApp } from 'vue'
import App from './App.vue';

import {
  ElBadge,
  ElButton,
  ElButtonGroup,
  ElCheckbox,
  ElCheckboxButton,
  ElCheckboxGroup,
  ElCol,
  ElColorPicker,
  ElDialog,
  ElForm,
  ElFormItem,
  ElIcon,
  ElImage,
  ElInput,
  ElInputNumber,
  ElOption,
  ElOptionGroup,
  ElPagination,
  ElPopover,
  ElRadio,
  ElRadioButton,
  ElRadioGroup,
  ElRow,
  ElSelect,
  ElSwitch,
  ElTabPane,
  ElTabs,
  ElTable,
  ElTableColumn,
  ElTooltip,
  ElLoading,
  ElMessage,
  ElMain,
} from 'element-plus';

const components = [
  ElBadge,
  ElButton,
  ElButtonGroup,
  ElCheckbox,
  ElCheckboxButton,
  ElCheckboxGroup,
  ElCol,
  ElColorPicker,
  ElDialog,
  ElForm,
  ElFormItem,
  ElIcon,
  ElImage,
  ElInput,
  ElInputNumber,
  ElOption,
  ElOptionGroup,
  ElPagination,
  ElPopover,
  ElRadio,
  ElRadioButton,
  ElRadioGroup,
  ElRow,
  ElSelect,
  ElSwitch,
  ElTabPane,
  ElTabs,
  ElTable,
  ElTableColumn,
  ElTooltip,
  ElMain,
]

const plugins = [
  ElLoading,
  ElMessage,
]

const app = createApp(App)

components.forEach(component => {
  app.component(component.name, component)
})

plugins.forEach(plugin => {
  app.use(plugin)
})

export default app;