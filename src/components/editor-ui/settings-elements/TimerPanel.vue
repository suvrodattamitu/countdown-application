<template>
    <div>
        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">REMAINING TIME PERIOD</label>
                    <el-input-number v-model="timer_configs.time_period" size="mini" :min="1" :max="10"></el-input-number>
                </div>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">SET THE TIME IN</label>
                    <el-select v-model="timer_configs.time_unit" clearable placeholder="Select" size="mini">
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
                    <label class="ninja_countdown_label">MESSAGE BEFORE TIMER</label>
                    <el-input type="text" v-model="timer_configs.message"></el-input>
                </div>
            </el-col>
        </el-row>

        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <el-badge value="Pro" class="item" type="danger">
                        <label class="ninja_countdown_label">IMAGE BEFORE TIMER</label>
                    </el-badge>
                    <photo-widget
                        btn_type="primary"
                        :btn_text="'Select File'"
                        :btn_mode="true"
                        @changed="updateAvatar"
                        v-model="timer_configs.image_url"
                    />
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script type="text/babel">
import PhotoWidget from '../pieces/PhoroWidget.vue';

export default {
    props:['timer_configs'],
    data() {
        return {
            options: [{
                value: 'days',
                label: 'Days'
                }, {
                value: 'hours',
                label: 'Hours'
                }, {
                value: 'minutes',
                label: 'Minutes'
            }],
        }
    },
    components: {
        PhotoWidget
    },
    methods: {
        updateAvatar(val) {

        }
    }
}
</script>