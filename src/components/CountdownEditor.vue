<template>
    <div class="ninja_countdown_wrapper" v-loading="loading">
        <div class="ninja_countdown_editor" v-if="configs">
            <div class="ninja_countdown_preview">
                <countdown :all_configs="configs"></countdown>

                <!-- {{ get_timer_value(configs.timer.currentdatetime,configs.timer.time_period, configs.timer.time_unit) }} -->

            </div>
            <div class="ninja_countdown_settings" v-if="configs">
                <div class="header">
                    <el-button type="primary" size="mini">
                        Update
                    </el-button>
                </div>

                <div class="settings_panel">

                    <el-tabs type="border-card">

                        <el-tab-pane>
                            <template #label>
                                <span class="icon-style"><i class="el-icon-date"></i> Timer</span>
                            </template>
                            <timer-panel :timer_configs="configs.timer"></timer-panel>
                        </el-tab-pane>

                        <el-tab-pane>
                            <template #label>
                                <span class="icon-style"><i class="el-icon-video-play"></i>Button</span>
                            </template>
                            <button-panel :button_configs="configs.button"></button-panel>
                        </el-tab-pane>

                        <el-tab-pane >
                            <template #label>
                                <span class="icon-style"><i class="el-icon-edit"></i>Style</span>
                            </template>
                            <style-panel :styles_configs="configs.styles"></style-panel>
                        </el-tab-pane>

                    </el-tabs>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

import Countdown from '../components/editor-ui/countdown/Countdown'
import StylePanel from '../components/editor-ui/settings-elements/StylePanel'
import ButtonPanel from '../components/editor-ui/settings-elements/ButtonPanel'
import TimerPanel from '../components/editor-ui/settings-elements/TimerPanel'

export default {
    components:{
        Countdown,
        StylePanel,
        TimerPanel,
        ButtonPanel,
    },

    data() {
        return {
            val:'',
            val1:'',
            activeName: "1",
            configs: false,
            loading: false
        }
    },

    methods: {
        getConfigs() {
            this.loading = true
            this.$adminGet({
                route: 'get_configs'
            })
                .then(response => {
                    if( response.data ) {
                        this.configs = response.data.configs
                    }
                })
                .fail(error => {
                })
                .always(() => {
                    this.loading = false
                });
        }
    },

    mounted() {
        this.getConfigs();
        //this.get_timer_value();
    }
}

</script>