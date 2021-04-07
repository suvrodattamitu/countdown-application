<template>
    <div>
        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">POSITION</label>
                    <el-radio-group v-model="styles_configs.position">
                        <el-radio :label="'top'">Top</el-radio>
                        <el-radio :label="'bottom'">Bottom</el-radio>
                    </el-radio-group>
                </div>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">Timer Animation</label>
                    <el-select v-model="styles_configs.animation" clearable placeholder="Select" size="mini">
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
                                        v-model="styles_configs.timer_color" 
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
                                        v-model="styles_configs.button_color" 
                                        show-alpha>
                                    </el-color-picker>
                                </div>
                            </div>
                        </div>

                        <div class="bgColorList">
                            <div class="block-container">
                                <div class="title">
                                    <p>{{ 'BUTTON TEXT COLOR' }}</p>
                                </div>
                                <div class="color-picker">
                                    <el-color-picker
                                        size="mini" 
                                        v-model="styles_configs.button_text_color" 
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
                                        v-model="styles_configs.background_color" 
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
                                        v-model="styles_configs.message_color" 
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

<script>
export default {
    props:['styles_configs'],
    data() {
        return {
            val:'',
            color:'',
            activeName: "1",
            options: [{
                value: 'none',
                label: 'None'
                }, {
                value: 'flip',
                label: 'Flip'
                }, {
                value: 'slide',
                label: 'Slide'
            }],
        }
    },

    methods: {
        
        generateCSS(prefix, styleVars) {
                let [countdown,button,timer] = styleVars;
                return `
                    /* Header Color Styling */
                        ${prefix} {
                        background-color: ${countdown.bg};
                        ${countdown.position}:0;
                    }
                    ${prefix} .ninja-countdown-timer-header-title-text{
                        color: ${countdown.msgColor};
                    }
                    ${prefix} .ninja-countdown-timer-button{
                        background-color: ${button.bg};
                        color: ${button.txtColor}
                    }
                    ${prefix} .ninja-countdown-timer-item{
                        color: ${timer.color}
                    }
                    `
        },

        getStyleVars() {
            let countdown,button,timer = {};
            countdown = {
                bg: this.styles_configs.background_color,
                msgColor: this.styles_configs.message_color,
                position: this.styles_configs.position,
            };
            timer = {
                color: this.styles_configs.timer_color
            };
            button = {
                bg: this.styles_configs.button_color,
                txtColor: this.styles_configs.button_text_color
            };
            return [countdown,button,timer];
        },

        reloadCss() {
            let styleVars = this.getStyleVars();
            let countdownCss = this.generateCSS('.ninja-countdown-timer-1', styleVars);
            jQuery('#ninja_countdown_dynamic_style').html(countdownCss);
        }
    },

    watch: {
        styles_configs: {
            handler(val){
                window.mitt.emit('update_css')
            },
            deep: true
        }
    },

    mounted() {
        window.mitt.on('update_css', () => {
            if (this.styles_configs) {
                console.log('hi')
                this.reloadCss();
            }
        });
    }
}
</script>