
(cl:in-package :asdf)

(defsystem "am2315-msg"
  :depends-on (:roslisp-msg-protocol :roslisp-utils :std_msgs-msg
)
  :components ((:file "_package")
    (:file "Environment" :depends-on ("_package_Environment"))
    (:file "_package_Environment" :depends-on ("_package"))
  ))