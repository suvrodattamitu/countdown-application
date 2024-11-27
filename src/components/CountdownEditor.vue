<template>
    <div class="ninja_countdown_wrapper">
        <div class="ninja_countdown_editor">
            <div class="wpp_section_header">
                <div class="wpp_section_title">
                    <div class="ninja_countdown_editor_header_show" v-if="!title_editing">
                        <i style="cursor: pointer" @click="title_editing = true" class="el-icon-edit">{{countdown_details.post_title}}</i>
                    </div>
                    <div v-else class="ninja_countdown_editor_header_editing">
                        <el-input placeholder="Table Name" size="mini" v-model="countdown_details.post_title"></el-input>
                        <el-button type="success" size="mini" @click="updateCountdownTitle">Save</el-button>
                    </div>
                </div>
                <div class="wpp_section_logo">
                    <div class="wpp_upgrade_logo">
                        <code class="copy_clipboard"
                            :data-clipboard-text='`[ninja_countdown_layout id="${countdown_details.ID}"]`'>
                            <i class="el-icon-document"></i> [ninja_countdown_layout id="{{ countdown_details.ID }}"]
                        </code>
                    </div>
                </div>
                <div class="wpp_section_actions">
                    <el-button size="mini" type="primary" @click="updateConfigs">
                        Update
                    </el-button>
                </div>
            </div>
            <div class="ninja_countdown_editor_body">
                <div class="ninja_countdown_preview" v-loading.body="loading"  element-loading-text="Loading...">
                    <el-main  class="main_items"> 
                        <div v-if="countdown_meta" :class="[countdown_meta.styles.position !== 'required_position' ? '': 'centered-counter-timer']">
                            <countdown :all_configs="countdown_meta"></countdown>
                        </div>
                    </el-main>
                </div>
                <div class="ninja_countdown_settings" v-if="countdown_meta">
                    <div class="settings_panel">
                        <el-tabs type="border-card">
                            <el-tab-pane>
                                <template #label>
                                    <span class="icon-style"><i class="el-icon-date"></i> Timer</span>
                                </template>
                                <timer-panel :timer_configs="countdown_meta.timer"></timer-panel>
                            </el-tab-pane>
                            <el-tab-pane>
                                <template #label>
                                    <span class="icon-style"><i class="el-icon-picture"></i>Image</span>
                                </template>
                                <image-panel :image_configs="countdown_meta.image"></image-panel>
                            </el-tab-pane>
                            <el-tab-pane>
                                <template #label>
                                    <span class="icon-style"><i class="el-icon-video-play"></i>Button</span>
                                </template>
                                <button-panel :button_configs="countdown_meta.button"></button-panel>
                            </el-tab-pane>
                            <el-tab-pane >
                                <template #label>
                                    <span class="icon-style"><i class="el-icon-edit"></i>Style</span>
                                </template>
                                <style-panel :styles_configs="countdown_meta.styles"></style-panel>
                            </el-tab-pane>
                        </el-tabs>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
import Countdown from '../components/editor-ui/countdown-timer/CountdownTimer';
import StylePanel from '../components/editor-ui/settings-elements/StylePanel';
import ButtonPanel from '../components/editor-ui/settings-elements/ButtonPanel';
import ImagePanel from '../components/editor-ui/settings-elements/ImagePanel';
import TimerPanel from '../components/editor-ui/settings-elements/TimerPanel';
import Remove from '../components/editor-ui/pieces/Remove';
import Clipboard from 'clipboard';

export default {
    components:{
        Countdown,
        StylePanel,
        TimerPanel,
        ButtonPanel,
        ImagePanel,
        Remove
    },
    data() {
        return {
            activeName: "1",
            title_editing: false,
            countdown_details:false,
            countdown_meta: false,
            loading: false,
            countdown_id: this.$route.params.countdown_id
        }
    },
    methods: {
        updateConfigs() {
            this.loading = true
            this.$adminPost({
                route: 'update_countdown_meta',
                countdown_id: this.countdown_id,
                countdown_meta: JSON.stringify(this.countdown_meta)
            })
                .then(response => {
                    if( response.data ) {
                        this.$message({
                            showClose: true,
                            message: response.data.message,
                            type: 'success'
                        });
                        this.getConfigs();
                    }
                }).fail(error => {

                }).always(() => {
                    this.loading = false
                });
        },
        getConfigs() {
            this.loading = true
            this.$adminGet({
                route: 'get_countdown_meta',
                countdown_id: this.$route.params.countdown_id
            })
                .then(response => {
                    if( response.data ) {
                        this.countdown_meta = response.data.countdown_meta;
                        this.countdown_details = response.data.countdown_details;
                        window.mitt.emit('update_css');
                    }
                }).fail(error => {
                    
                }).always(() => {
                    this.loading = false
                });
        },
        updateCountdownTitle(){
            if (this.countdown_details && !this.countdown_details.post_title) {
                this.$message({
                    showClose: true,
                    message: 'Please Provide Countdown Title',
                    type: 'error'
                });
                return;
            }
            this.loading = true
            this.$adminPost({
                route: 'update_countdown_title',
                countdown_id: this.countdown_id,
                countdown_title: this.countdown_details.post_title
            })
                .then(response => {
                    if( response.data ) {
                        this.$message({
                            showClose: true,
                            message: response.data.message,
                            type: 'success'
                        });
                        this.title_editing = false;
                    }
                }).fail(error => {

                }).always(() => {
                    this.loading = false
                });
        },
        //css generate start 
        generateCSS(prefix) {
            let countdown_meta = this.countdown_meta;
            return `
                /* Header Color Styling */
                    ${prefix} .ninja-countdown-timer-container{
                    background-color: ${countdown_meta.styles.background_color};
                }
                ${prefix} .ninja-countdown-timer-header-title-text{
                    color: ${countdown_meta.styles.message_color};
                }
                ${prefix} .ninja-countdown-timer-button{
                    background-color: ${countdown_meta.styles.button_color};
                    color: ${countdown_meta.styles.button_text_color}
                }
                ${prefix} .ninja-countdown-timer-item{
                    color: ${countdown_meta.styles.timer_color}
                }
             `
        },
        reloadCss() {
            let countdownCss = this.generateCSS('.ninja-wrapper-styler');
            jQuery('#ninja_countdown_dynamic_style').html(countdownCss);  
        },
        //css generate end
        clipboard(){
            if( !window.clipboard ){
                window.clipboard = new Clipboard('.copy_clipboard');
                    window.clipboard.on('success', (e) => {
                    let message = 'Shortcode is Copied!'
                    this.$message({
                        showClose: true,
                        message: message,
                        type: 'success'
                    });
                });
            }
        }
    },
    watch:{
        'countdown_meta': {
            handler() {
                window.mitt.emit('update_css')
            },
            deep: true
        }
    },
    mounted() {
        this.getConfigs();
        window.mitt.on('update_css', () => {
            if (this.countdown_meta) {
                this.reloadCss();
            }
        });
        this.clipboard();
    }
}
</script>