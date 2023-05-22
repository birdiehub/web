import AppLayout from "@/layouts/AppLayout.vue";
import DashboardView from "@/views/App/DashboardView.vue";
import PlayersView from "@/views/App/PlayersView.vue";
import PlayerView from "@/views/App/PlayerView.vue";
import AuthenticationLayout from "@/layouts/AuthenticationLayout.vue";
import LoginView from "@/views/Authentication/LoginView.vue";
import RegisterView from "@/views/Authentication/RegisterView.vue";
import CreatePlayerView from "@/views/App/CreatePlayerView.vue";

export const routes = [
    {
        path: `/`,
        redirect: `/dashboard`,
        components: {
            Layout: AppLayout
        },
        children: [
            {
                path: `/dashboard`,
                name: 'Dashboard',
                components: {
                    App: DashboardView
                },
                meta: {
                    protected: true,
                    permissions: []
                }
            },
            {
                path: '/players',
                name: 'Players',
                components: {
                    App: PlayersView
                },
                meta: {
                    protected: true,
                    permissions: [
                        'view-players-list'
                    ]
                }
            },
            {
                path: '/players/:id',
                name: 'Player',
                components: {
                    App: PlayerView
                },
                meta: {
                    protected: true,
                    permissions: [
                        'view-players-details'
                    ]
                }
            },
            {
                path: '/players/create',
                name: 'Create Player',
                components: {
                    App: CreatePlayerView
                },
                meta: {
                    protected: true,
                    permissions: [
                        'create-players'
                    ]
                }
            }
        ]
    },
    {
        path: `/auth`,
        redirect: `/auth/login`,
        components: {
            Layout: AuthenticationLayout
        },
        children: [
            {
                path: `/auth/login`,
                name: 'Login',
                components: {
                    Authentication: LoginView
                },
                meta: {
                    protected: false,
                    permissions: []
                }
            },
            {
                path: `/auth/register`,
                name: 'Register',
                components: {
                    Authentication: RegisterView
                },
                meta: {
                    protected: false,
                    permissions: []
                }
            }
        ]
    }
];
