<template>
    <div class="notification-data">
        <div class="flex justify-between p-3">
            <div class='notification-text-block flex w-full'>
                <div class="bg-amber-500 w-10 h-10 rounded-full flex items-center justify-center">
                    <TrashIcon class="h-6 w-6 text-white" aria-hidden="true" />
                </div>
                <div class="ml-6 w-full">
                    <div>
                        <h5 class="text-gray-400 text-lg">Remove Learning Path Member
                        </h5>
                        <div class="flex justify-between">
                            <div class="themeNotifyName" v-if="notification.data.is_support">
                                <span class="text-gray-600 text-base breakWord themeManageTitle">
                                    XME
                                    Support(logged as
                                    <b>{{data.from_user_name }})</b>
                                    has remove {{ data.member_name }} member 
                                    from {{ data.learning_path_title }} Learning Path
                                </span>
                            </div>
                            <div class="themeNotifyName" v-else>
                                <span class="text-gray-600 text-base breakWord themeManageTitle">
                                    <b>{{ data.from_user_name }}</b>
                                    has remove {{ data.member_name }} member 
                                    from {{ data.learning_path_title }} Learning Path
                                </span>
                            </div>
                            <span class='text-gray-400 text-sm'>{{ notification.differenceDate }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { TrashIcon } from '@heroicons/vue/24/solid';
export default {
    name: 'RemoveLearningPathMember',
    props: ['data', 'differenceDate', 'userRole', 'notification', 'user'],
    components: {
        TrashIcon
    },
}
</script>
