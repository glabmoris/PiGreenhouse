;; Auto-generated. Do not edit!


(when (boundp 'am2315::Environment)
  (if (not (find-package "AM2315"))
    (make-package "AM2315"))
  (shadow 'Environment (find-package "AM2315")))
(unless (find-package "AM2315::ENVIRONMENT")
  (make-package "AM2315::ENVIRONMENT"))

(in-package "ROS")
;;//! \htmlinclude Environment.msg.html
(if (not (find-package "STD_MSGS"))
  (ros::roseus-add-msgs "std_msgs"))


(defclass am2315::Environment
  :super ros::object
  :slots (_header _temperature _humidity ))

(defmethod am2315::Environment
  (:init
   (&key
    ((:header __header) (instance std_msgs::Header :init))
    ((:temperature __temperature) 0.0)
    ((:humidity __humidity) 0.0)
    )
   (send-super :init)
   (setq _header __header)
   (setq _temperature (float __temperature))
   (setq _humidity (float __humidity))
   self)
  (:header
   (&rest __header)
   (if (keywordp (car __header))
       (send* _header __header)
     (progn
       (if __header (setq _header (car __header)))
       _header)))
  (:temperature
   (&optional __temperature)
   (if __temperature (setq _temperature __temperature)) _temperature)
  (:humidity
   (&optional __humidity)
   (if __humidity (setq _humidity __humidity)) _humidity)
  (:serialization-length
   ()
   (+
    ;; std_msgs/Header _header
    (send _header :serialization-length)
    ;; float64 _temperature
    8
    ;; float64 _humidity
    8
    ))
  (:serialize
   (&optional strm)
   (let ((s (if strm strm
              (make-string-output-stream (send self :serialization-length)))))
     ;; std_msgs/Header _header
       (send _header :serialize s)
     ;; float64 _temperature
       (sys::poke _temperature (send s :buffer) (send s :count) :double) (incf (stream-count s) 8)
     ;; float64 _humidity
       (sys::poke _humidity (send s :buffer) (send s :count) :double) (incf (stream-count s) 8)
     ;;
     (if (null strm) (get-output-stream-string s))))
  (:deserialize
   (buf &optional (ptr- 0))
   ;; std_msgs/Header _header
     (send _header :deserialize buf ptr-) (incf ptr- (send _header :serialization-length))
   ;; float64 _temperature
     (setq _temperature (sys::peek buf ptr- :double)) (incf ptr- 8)
   ;; float64 _humidity
     (setq _humidity (sys::peek buf ptr- :double)) (incf ptr- 8)
   ;;
   self)
  )

(setf (get am2315::Environment :md5sum-) "b4e9cf4dd4a8fb88b9ee33bf3f10d35b")
(setf (get am2315::Environment :datatype-) "am2315/Environment")
(setf (get am2315::Environment :definition-)
      "Header header
float64 temperature
float64 humidity

================================================================================
MSG: std_msgs/Header
# Standard metadata for higher-level stamped data types.
# This is generally used to communicate timestamped data 
# in a particular coordinate frame.
# 
# sequence ID: consecutively increasing ID 
uint32 seq
#Two-integer timestamp that is expressed as:
# * stamp.sec: seconds (stamp_secs) since epoch (in Python the variable is called 'secs')
# * stamp.nsec: nanoseconds since stamp_secs (in Python the variable is called 'nsecs')
# time-handling sugar is provided by the client library
time stamp
#Frame this data is associated with
string frame_id

")



(provide :am2315/Environment "b4e9cf4dd4a8fb88b9ee33bf3f10d35b")


