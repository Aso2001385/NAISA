```uml
@startuml
!define Color_T Lime
!define Color_R Red
!define Color_C DeepSkyBlue

skinparam class {
  BackgroundColor DarkGrey-Snow
  BorderColor Black
  ArrowColor Black
  IconFontColor Snow
}

package "本システム" as main_system{
  package "アカウントシステム" as account_system{
    entity "生徒" as users <<T,Color_T>> {
      + id [PK]
      --
      number
      class
      name
      email
      password
    }
  }
  package "チャットシステム" as chat_system{
    entity "チャットルーム" as rooms<<T,Color_T>> {
      + id [PK]
    }
    entity "ルーム参加者" as room_user <<T,Color_T>> {
      + id [PK]
      --
      room_id [FK]
      user_id [FK]
      name
    }
    entity "チャット" as chats <<T,Color_T>> {
      + id [PK]
      --
      room_id [FK]
      user_id [FK]
      message
      read
    }
  }
  package "スキルシステム" as skill_system{
    entity "スキル" as skills <<T,Color_T>> {
      + id [PK]
      --
      name
      category
      depth
    }
    entity "親子スキル" as skill_relations <<T,Color_T>> {
      + id [PK]
      --
      primary_skill_id [FK]
      secondary_skill_id [FK]
    }
    entity "登録スキル" as user_skill <<T,Color_T>> {
      + id [PK]
      --
      user_id [FK]
      skill_id [FK]
      practical_flag
      learning_flag
      level
    }
  }
  package "募集システム" as recruit_system{
    entity "募集" as recruits <<T,Color_T>> {
      + id [PK]
      --
      user_id [FK]
      title
      contents
      purpose
      persons
      due
    }
    entity "募集スキル" as recruit_skill <<T,Color_T>> {
      + id [PK]
      --
      recruit_id [FK]
      skill_id [FK]
      level
    }
    entity "募集参加者" as recruit_user <<T,Color_T>> {
      + id [PK]
      --
      recruit_id [FK]
      user_id [FK]
    }
  }
  package "管理システム" as management_system{
    entity "教師" as teachers <<T,Color_T>> {
      + id [PK]
      --
      name
      email
      password
    }
    entity "イベント" as events <<T,Color_T>> {
      + id [PK]
      --
      teacher_id [FK]
      title
      contents
      due
    }
    entity "スキル申請" as skill_requests <<T,Color_T>> {
      + id [PK]
      --
      user_id [FK]
      name
      message
    }
    entity "スキル受理" as skill_request_teacher <<T,Color_T>> {
      + id [PK]
      --
      skill_request_id [FK]
      skill_id [FK]
      teachar_id [FK]
    }
    entity "お知らせ" as informations <<T,Color_T>> {
      + id [PK]
      --
      user_id [FK]
      title
      contents
      read
      category
      url
    }
  }
}
  
  events }o-l-|| teachars
  teachars ||-l-o{ skill_request_teachar
  skill_request_teachar ||-l-|| skill_request
  informateions }o-rd-|| users
  skill_relations }|-l-|| skills
  skills ||-l-o{ user_skill
  user_skill }o-l-|| users
  users ||-l-o{ room_user
  users ||-l-d-o{ chat
  room_user ||-d-o{ chat
  room ||-r-u-|{ room_user
  room ||-r-o{ chat
  recruit_skill }|-l-|| recruits
  recruits ||-l-o{ recruit_user
  
