<template>
    <div class="predefinedModal">
        <el-dialog
            title="Design a new popup"
            v-model="visibility"
            :before-close="close"
            top="40px"
            width="55%"
        >
            <div v-loading="fetching" class="fizzy-popup-group">
                <div v-for="(popup, name) in predefinedTemplates" :key="name" class="fizzy-popup">
                    <div class="fizzy-popup-inner-item">
                        <p class="fizzy-popup-header-title">{{ popup.title }}</p>
                        <img :src="popup.image" alt="">
                        <div class="fizzy-popup-inner-text fizzy-popup-inner-text-hoverable">
                            <h3 class="fizzy-modal-title">{{ popup.title }}</h3>
                            <div>
                                <el-button :loading="creatingTemplate" type="primary" size="small"
                                    @click="createPopupMeta(name, popup)"
                                >
                                    {{ creatingTemplate ? 'Creating Layout...' : 'Create Layout' }}
                                </el-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: 'predefinedFormsModal',
        props: {
            visibility: Boolean
        },
        emits: ['update:visibility'],
        data() {
            return {
                creatingTemplate: false,
                predefinedTemplates: [],
                isNewForm: false,
                selectedPredefinedForm: '',
                form_title: '',
                fetching: false
            }
        },
        methods: {
            close() {
                this.$emit('update:visibility', false);
                this.isNewForm = false;
            },
            fetchPredefinedTemplates() {
                this.fetching = true
                this.$adminGet({
                    route: 'get_predefined_template'
                })
                    .then(response => {
                        if( response.data ) {
                            this.predefinedTemplates = response.data.templates
                        }
                    }).fail(error => {

                    }).always(() => {
                        this.fetching = false
                    });
            },
            createPopupMeta(templateType, form) {
                this.creatingTemplate = true
                this.$adminPost({
                    route: 'create_countdown_meta',
                    type: templateType
                })
                    .then(response => {
                        if( response.data ) {
                            this.$message({
                                showClose: true,
                                message: response.data.message,
                                type: 'success'
                            });
                            let templateId = response.data.template_id;
                            this.$router.push('/countdown-editor/'+templateId);
                        }
                    }).fail(error => {
                        this.$message({
                            showClose: true,
                            message: 'Failed to create new template',
                            type: 'error'
                        });
                    }).always(() => {
                        this.creatingTemplate = false
                    });
            },
            gotoPage(url) {
                location.href = url;
            }
        },
        mounted() {
            this.fetchPredefinedTemplates();
        }
    }
</script>

<style lang="scss">

    .predefinedModal {
        .el-dialog__title {
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }
    }
    .el-overlay {
        left: 160px;
    }

    .fizzy-popup {
        &-group {
            overflow: hidden;
            .fizzy-popup {
                margin-right: 10px;
                margin-bottom: 30px;
            }
        }

        width: 200px;
        // height: 250px;
        border: 1px solid #ccc;
        display: inline-block;
        padding: 5px;
        transition: border 0.3s;
        overflow: hidden;

        .fizzy-popup {
            margin-right: 10px;
        }

        img {
            width: 100%;
            height: auto;
            display: block;
        }

        &-header-title {
            text-align: center;
            margin: 0px;
            background: #409eff;
            padding: 6px;
            font-size: 15px;
            color: #fff;
            font-weight: 400;
        }

        &-inner-item {
            position: relative;
            overflow: hidden;
            height: inherit;
        }

        &:hover {
            .fizzy-popup-inner-text {
                opacity: 1;
                visibility: visible;
            }
        }

        &-inner-text {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;

            &-hoverable {
                opacity: 0;
                visibility: hidden;
                position: absolute;
                transition: all 0.3s;
                color: #fff;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                padding: 10px;
                background-color: rgba(0,0,0,0.6);
            }

            .fizzy-modal-title {
                color: #fff;
                margin: 0 0 10px;
            }
        }
    }
</style>
