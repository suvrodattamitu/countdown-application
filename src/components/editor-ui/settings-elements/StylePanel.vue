<template>
    <div>
        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">POSITION</label>
                    <el-radio-group v-model="styles_configs.position">
                        <el-radio :label="'top'">Top</el-radio>
                        <el-radio :label="'bottom'">Bottom</el-radio>
                        <el-radio :label="'required_position'">Required Position</el-radio>
                    </el-radio-group>
                </div>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <el-badge value="Pro" class="item" type="danger">
                        <label class="ninja_countdown_label">Timer Animation</label>
                    </el-badge>
                    <el-select class="ninja_select" v-model="styles_configs.animation" clearable placeholder="Select" size="mini">
                        <el-option
                        v-for="item in options"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value"
                        :disabled="item.disabled">
                        </el-option>
                    </el-select>
                </div>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">COLORS :</label>
                    <div class="color-customization">
                        <div class="bgColorList">
                            <div class="block-container">
                                <div class="title">
                                    <p>{{ 'TIMER COLOR' }}</p>
                                </div>
                                <color-picker v-model="styles_configs.timer_color"></color-picker>
                            </div>
                        </div>
                        <div class="bgColorList">
                            <div class="block-container">
                                <div class="title">
                                    <p>{{ 'BUTTON COLOR' }}</p>
                                </div>
                                <color-picker v-model="styles_configs.button_color"></color-picker>
                            </div>
                        </div>
                        <div class="bgColorList">
                            <div class="block-container">
                                <div class="title">
                                    <p>{{ 'BUTTON TEXT COLOR' }}</p>
                                </div>
                                <color-picker v-model="styles_configs.button_text_color"></color-picker>
                            </div>
                        </div>
                        <div class="bgColorList">
                            <div class="block-container">
                                <div class="title">
                                    <p>{{ 'BACKGROUND COLOR' }}</p>
                                </div>
                                <color-picker v-model="styles_configs.background_color"></color-picker>
                            </div>
                        </div>
                        <div class="bgColorList">
                            <div class="block-container">
                                <div class="title">
                                    <p>{{ 'MESSAGE COLOR' }}</p>
                                </div>
                                <color-picker v-model="styles_configs.message_color"></color-picker>
                            </div>
                        </div>
                    </div>
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script type="text/babel">
import ColorPicker from '../pieces/ColorPicker.vue';

export default {
    props:['styles_configs'],
    data() {
        return {
            options: [{
                value: 'none',
                label: 'None',
                disabled: !this.has_pro ? true : false
                }, {
                value: 'flip',
                label: 'Flip',
                disabled: !this.has_pro ? true : false
                }, {
                value: 'slide',
                label: 'Slide',
                disabled: !this.has_pro ? true : false
            }],
        }
    },
    components: {
        ColorPicker
    },
    watch: {
        styles_configs: {
            handler(val){
                window.mitt.emit('update_css');
            },
            deep: true
        }
    }
}
</script>