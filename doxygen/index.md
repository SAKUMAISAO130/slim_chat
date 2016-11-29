@startuml

node "■■ SlimChat ■■" {
  frame "Vagrant(VirtualBox)" {



      node "Node" {
        database "Database" {
          [store]
        }
      }
      package "apache" {
        folder "Folder" {
          [File]
        }
      }




  }
}



@enduml
