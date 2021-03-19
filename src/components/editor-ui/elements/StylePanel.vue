<template>
    <div>
        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">Timer Animation</label>
                    <el-select v-model="val" clearable placeholder="Select" size="mini">
                        <el-option
                        v-for="item in options"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                        </el-option>
                    </el-select>
                </div>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">Colors</label>
                    <div class="color-customization">
                        <div class="bgColorList">
                            <div class="block-container">
                                <div class="title">
                                    <p>{{ 'TIMER COLOR' }}</p>
                                </div>
                                <div class="color-picker">
                                    <el-color-picker
                                        size="mini" 
                                        v-model="color" 
                                        show-alpha>
                                    </el-color-picker>
                                </div>
                            </div>
                        </div>

                        <div class="bgColorList">
                            <div class="block-container">
                                <div class="title">
                                    <p>{{ 'BUTTON COLOR' }}</p>
                                </div>
                                <div class="color-picker">
                                    <el-color-picker
                                        size="mini" 
                                        v-model="color" 
                                        show-alpha>
                                    </el-color-picker>
                                </div>
                            </div>
                        </div>

                        <div class="bgColorList">
                            <div class="block-container">
                                <div class="title">
                                    <p>{{ 'BACKGROUND COLOR' }}</p>
                                </div>
                                <div class="color-picker">
                                    <el-color-picker
                                        size="mini" 
                                        v-model="color" 
                                        show-alpha>
                                    </el-color-picker>
                                </div>
                            </div>
                        </div>

                        <div class="bgColorList">
                            <div class="block-container">
                                <div class="title">
                                    <p>{{ 'MESSAGE COLOR' }}</p>
                                </div>
                                <div class="color-picker">
                                    <el-color-picker
                                        size="mini" 
                                        v-model="color" 
                                        show-alpha>
                                    </el-color-picker>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<style lang="scss">
.color-customization {
            .bgColorList {
                width: 49%;
                float: left;
                max-height: 100px;
                position: relative;
                .el-input {
                    width: 98%;
                }
            }

            .textColorList {
                width: 48%;
                float: right;
                .gdpr_text_color-picker {
                    position: relative;
                    top: -34px;
                    left: 189px;
                    display: block;
                }
            }

            .btnbackground {
                width: 48%;
                float: left;
                margin-top: -23px;
                .gdpr_btn_bg_color {
                    position: relative;
                    top: -34px;
                    left: 189px;
                    display: block;
                }
            }

            .btnColorList {
                width: 48%;
                float: right;
                margin-top: -23px;
                .gdpr_btn_bg_color {
                    position: relative;
                    top: -34px;
                    left: 189px;
                    display: block;
                }
            }
        }

    .bgColorList {
        .block-container {
            //text-align: center;
            .title {
                display: inline-block;
            }
            .color-picker {
                display: inline-block;
                position: absolute;
                top: 8px;
                .el-color-picker  {
                    .el-color-picker__trigger {
                        margin-left: 5px;
                    }
                }
            }
        }
    }
</style>

<script>
export default {
    data() {
        return {
            val:'',
            color:'',
            activeName: "1",
            options: [{
                value: 'Option1',
                label: 'Option1'
                }, {
                value: 'Option2',
                label: 'Option2'
                }, {
                value: 'Option3',
                label: 'Option3'
            }],
        }
    }
}
</script>