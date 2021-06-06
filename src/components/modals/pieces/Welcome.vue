<template>
<div class="show_fizzy_popup_modal_container">
    <div class="fizzy-popup-modal-items">
        <h4>Welcome to Fizzy Popups. Cutest popup plugin for wordpress</h4>
        <el-button type="success" @click="$emit('update:modelValue', true)">Add New Pupup</el-button>
    </div>
</div>
</template>

<style lang="scss">
    .show_fizzy_popup_modal_container {
        display:flex;
        align-items:center;
        justify-content:center;
        margin-top:50px;
        background: white;
        padding: 20px 30px;
        .fizzy-popup-modal-items {
            display:flex;
            align-items:center;
            justify-content:center;
            flex-direction: column;
            background-color: #fff;
            padding: 15px;
        }
    }
</style>

<script type="text/babel">
export default{
    props: ['modelValue'],
    emits: ['update:modelValue'],
}
</script>