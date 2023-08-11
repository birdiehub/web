table users {
  id integer [PK]
  username string
  password string
  first_name string
  last_name string
  email string
  phone string
  address string
  city string
  zip string
  country_id integer [ref: > countries.id]
}



table players {
  id integer [PK]
  first_name string
  last_name string
  full_name string
  headshot string
  is_amateur boolean
  birth_date datetime
  turned_pro integer
  college string
  graduation_year integer
  career_earnings integer
  height_imperial string
  height_meters string
  weight_imperial string
  weight_kilograms string
  gender json // translatable
  bio json // translatable
  degree json // translatable
  family json // translatable
  country_id integer [ref: > countries.id]
}


table countries {
  id integer [PK]
  code string
  name json // translatable
}


table socials {
  id integer [PK]
  player_id integer [ref: > players.id]
  channel string
  url string
}

table snapshots {
  id integer [PK]
  player_id integer [ref: > players.id]
  title json // translatable
  value json // translatable
  description json // translatable
}

table leaderboard { 
  id integer [PK]
  player_id integer [ref: > players.id]
  week_number integer
  weekend_date string
  rank integer
  last_week_rank integer
  end_last_year_rank integer
  is_tied boolean
  points_lost integer
  points_won integer
  points_total integer
  points_average integer
  divisor_actual integer
  divisor_applied integer
}

table tours {
    id integer [PK]
    name string
}

table tournaments {
    id integer [PK]
    tour_id integer [ref: > tours.id]
    name string
    year integer
    course_id integer [ref: > courses.id]
    start_date string
    end_date string

}

table courses {
  id integer [PK]
  name string
  address string
  image string
}


table tournament_leaderboard {
  id integer [PK]
  tournament_id integer [ref: > tournaments.id]
  player_id integer [ref: > players.id]
  rank integer
  points_total integer
}

