<template>
    <div class="ninja_countdown_editor">
        <div class="ninja_countdown_preview">
            <countdown></countdown>
        </div>
        <div class="ninja_countdown_settings">
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
                        <timer-panel></timer-panel>
                    </el-tab-pane>

                    <el-tab-pane>
                        <template #label>
                            <span class="icon-style"><i class="el-icon-video-play"></i>Button</span>
                        </template>
                        <button-panel></button-panel>
                    </el-tab-pane>

                    <el-tab-pane >
                        <template #label>
                            <span class="icon-style"><i class="el-icon-edit"></i>Style</span>
                        </template>
                        <style-panel></style-panel>
                    </el-tab-pane>

                </el-tabs>

            </div>
        </div>
    </div>
</template>

<script>

import Countdown from '../components/editor-ui/countdown/Countdown'
import StylePanel from '../components/editor-ui/elements/StylePanel'
import ButtonPanel from '../components/editor-ui/elements/ButtonPanel'
import TimerPanel from '../components/editor-ui/elements/TimerPanel'

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
            activeName: "1"
        }
    }
}

</script>