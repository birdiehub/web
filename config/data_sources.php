<?php

return [
    'pga' => [
        'url' => 'https://orchestrator.pgatour.com/graphql',
        'header' => [
            'Origin' => 'https://www.pgatour.com',
            'Referer' => 'https://www.pgatour.com',
            'Content-Type' => 'application/json',
            'x-amz-user-agent' => 'aws-amplify/3.0.7',
            'x-api-key' => 'da2-gsrx5bibzbb4njvhl7t37wqyl4',
            'x-pgat-platform' => 'web'
        ],
        'queries' => [
            'players' => 'query PlayerDirectory($tourCode: TourCode!) {
                        playerDirectory(tourCode: $tourCode) {
                            tourCode
                            players {
                                id
                                isActive
                                firstName
                                lastName
                                shortName
                                displayName
                                alphaSort
                                country
                                countryFlag
                                headshot
                                playerBio {
                                    id
                                    age
                                    education
                                    turnedPro
                                }
                            }
                        }
                    }',
            'player' => 'query Player($playerId: ID!, $currentTour: TourCode) {
                            playerProfileOverview(playerId: $playerId, currentTour: $currentTour) {
                                headshot {
                                    image
                                }
                                standings {
                                    id
                                    logo
                                    logoDark
                                    title
                                    description
                                    total
                                    totalLabel
                                    rank
                                    rankLogo
                                    rankLogoDark
                                    webview
                                    webviewBrowserControls
                                }
                                snapshot {
                                    title
                                    value
                                    description
                                }
                            }
                            player(id: $playerId) {
                                bioLink
                                firstName
                                id
                                lastName
                                playerBio {
                                    birthplace {
                                        countryCode
                                        country
                                        city
                                        state
                                        stateCode
                                    }
                                    degree
                                    careerEarnings
                                    family
                                    graduationYear
                                    heightImperial
                                    heightMeters
                                    overview
                                    personal
                                    pronunciation
                                    residence {
                                        city
                                        country
                                        state
                                        countryCode
                                        stateCode
                                    }
                                    school
                                    social {
                                        type
                                        url
                                    }
                                    turnedPro
                                    weightImperial
                                    weightKilograms
                                    websiteURL
                                }
                            }
                        }'
        ]
    ],
    'wgr' => [
        'url' => 'https://apiweb.owgr.com/api/owgr/rankings/getRankings?pageSize=300&pageNumber=1&regionId=0&countryId=0&sortString=pointsTotal+DESC'
    ]
];
