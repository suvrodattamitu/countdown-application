<template>
    <div>
        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">SHOW IMAGE</label>
                    <el-switch
                    v-model="image_configs.show_image"
                    active-value="true"
                    inactive-value="false"
                    active-color="#13ce66">
                    </el-switch>
                </div>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">IMAGE POSITION</label>
                    <el-select v-model="image_configs.position" clearable placeholder="Select" size="mini">
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
                    <label class="ninja_countdown_label">IMAGE</label>
                    <photo-widget
                        btn_type="primary"
                        :btn_text="'Select File'"
                        :btn_mode="true"
                        @changed="updateAvatar"
                        v-model="image_configs.url"
                    />
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script type="text/babel">
import PhotoWidget from '../pieces/PhoroWidget.vue';

export default {
    props:['image_configs'],
    data() {
        return {
            options: [{
                value: 'before_timer',
                label: 'Before Timer'
            }, 
            {
                value: 'after_timer',
                label: 'After Timer'
            }]
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