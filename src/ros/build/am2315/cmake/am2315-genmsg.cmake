# generated from genmsg/cmake/pkg-genmsg.cmake.em

message(STATUS "am2315: 1 messages, 0 services")

set(MSG_I_FLAGS "-Iam2315:/home/ubuntu/PiGreenhouse/src/ros/src/am2315/msg;-Istd_msgs:/opt/ros/melodic/share/std_msgs/cmake/../msg")

# Find all generators
find_package(gencpp REQUIRED)
find_package(geneus REQUIRED)
find_package(genlisp REQUIRED)
find_package(gennodejs REQUIRED)
find_package(genpy REQUIRED)

add_custom_target(am2315_generate_messages ALL)

# verify that message/service dependencies have not changed since configure



get_filename_component(_filename "/home/ubuntu/PiGreenhouse/src/ros/src/am2315/msg/Environment.msg" NAME_WE)
add_custom_target(_am2315_generate_messages_check_deps_${_filename}
  COMMAND ${CATKIN_ENV} ${PYTHON_EXECUTABLE} ${GENMSG_CHECK_DEPS_SCRIPT} "am2315" "/home/ubuntu/PiGreenhouse/src/ros/src/am2315/msg/Environment.msg" "std_msgs/Header"
)

#
#  langs = gencpp;geneus;genlisp;gennodejs;genpy
#

### Section generating for lang: gencpp
### Generating Messages
_generate_msg_cpp(am2315
  "/home/ubuntu/PiGreenhouse/src/ros/src/am2315/msg/Environment.msg"
  "${MSG_I_FLAGS}"
  "/opt/ros/melodic/share/std_msgs/cmake/../msg/Header.msg"
  ${CATKIN_DEVEL_PREFIX}/${gencpp_INSTALL_DIR}/am2315
)

### Generating Services

### Generating Module File
_generate_module_cpp(am2315
  ${CATKIN_DEVEL_PREFIX}/${gencpp_INSTALL_DIR}/am2315
  "${ALL_GEN_OUTPUT_FILES_cpp}"
)

add_custom_target(am2315_generate_messages_cpp
  DEPENDS ${ALL_GEN_OUTPUT_FILES_cpp}
)
add_dependencies(am2315_generate_messages am2315_generate_messages_cpp)

# add dependencies to all check dependencies targets
get_filename_component(_filename "/home/ubuntu/PiGreenhouse/src/ros/src/am2315/msg/Environment.msg" NAME_WE)
add_dependencies(am2315_generate_messages_cpp _am2315_generate_messages_check_deps_${_filename})

# target for backward compatibility
add_custom_target(am2315_gencpp)
add_dependencies(am2315_gencpp am2315_generate_messages_cpp)

# register target for catkin_package(EXPORTED_TARGETS)
list(APPEND ${PROJECT_NAME}_EXPORTED_TARGETS am2315_generate_messages_cpp)

### Section generating for lang: geneus
### Generating Messages
_generate_msg_eus(am2315
  "/home/ubuntu/PiGreenhouse/src/ros/src/am2315/msg/Environment.msg"
  "${MSG_I_FLAGS}"
  "/opt/ros/melodic/share/std_msgs/cmake/../msg/Header.msg"
  ${CATKIN_DEVEL_PREFIX}/${geneus_INSTALL_DIR}/am2315
)

### Generating Services

### Generating Module File
_generate_module_eus(am2315
  ${CATKIN_DEVEL_PREFIX}/${geneus_INSTALL_DIR}/am2315
  "${ALL_GEN_OUTPUT_FILES_eus}"
)

add_custom_target(am2315_generate_messages_eus
  DEPENDS ${ALL_GEN_OUTPUT_FILES_eus}
)
add_dependencies(am2315_generate_messages am2315_generate_messages_eus)

# add dependencies to all check dependencies targets
get_filename_component(_filename "/home/ubuntu/PiGreenhouse/src/ros/src/am2315/msg/Environment.msg" NAME_WE)
add_dependencies(am2315_generate_messages_eus _am2315_generate_messages_check_deps_${_filename})

# target for backward compatibility
add_custom_target(am2315_geneus)
add_dependencies(am2315_geneus am2315_generate_messages_eus)

# register target for catkin_package(EXPORTED_TARGETS)
list(APPEND ${PROJECT_NAME}_EXPORTED_TARGETS am2315_generate_messages_eus)

### Section generating for lang: genlisp
### Generating Messages
_generate_msg_lisp(am2315
  "/home/ubuntu/PiGreenhouse/src/ros/src/am2315/msg/Environment.msg"
  "${MSG_I_FLAGS}"
  "/opt/ros/melodic/share/std_msgs/cmake/../msg/Header.msg"
  ${CATKIN_DEVEL_PREFIX}/${genlisp_INSTALL_DIR}/am2315
)

### Generating Services

### Generating Module File
_generate_module_lisp(am2315
  ${CATKIN_DEVEL_PREFIX}/${genlisp_INSTALL_DIR}/am2315
  "${ALL_GEN_OUTPUT_FILES_lisp}"
)

add_custom_target(am2315_generate_messages_lisp
  DEPENDS ${ALL_GEN_OUTPUT_FILES_lisp}
)
add_dependencies(am2315_generate_messages am2315_generate_messages_lisp)

# add dependencies to all check dependencies targets
get_filename_component(_filename "/home/ubuntu/PiGreenhouse/src/ros/src/am2315/msg/Environment.msg" NAME_WE)
add_dependencies(am2315_generate_messages_lisp _am2315_generate_messages_check_deps_${_filename})

# target for backward compatibility
add_custom_target(am2315_genlisp)
add_dependencies(am2315_genlisp am2315_generate_messages_lisp)

# register target for catkin_package(EXPORTED_TARGETS)
list(APPEND ${PROJECT_NAME}_EXPORTED_TARGETS am2315_generate_messages_lisp)

### Section generating for lang: gennodejs
### Generating Messages
_generate_msg_nodejs(am2315
  "/home/ubuntu/PiGreenhouse/src/ros/src/am2315/msg/Environment.msg"
  "${MSG_I_FLAGS}"
  "/opt/ros/melodic/share/std_msgs/cmake/../msg/Header.msg"
  ${CATKIN_DEVEL_PREFIX}/${gennodejs_INSTALL_DIR}/am2315
)

### Generating Services

### Generating Module File
_generate_module_nodejs(am2315
  ${CATKIN_DEVEL_PREFIX}/${gennodejs_INSTALL_DIR}/am2315
  "${ALL_GEN_OUTPUT_FILES_nodejs}"
)

add_custom_target(am2315_generate_messages_nodejs
  DEPENDS ${ALL_GEN_OUTPUT_FILES_nodejs}
)
add_dependencies(am2315_generate_messages am2315_generate_messages_nodejs)

# add dependencies to all check dependencies targets
get_filename_component(_filename "/home/ubuntu/PiGreenhouse/src/ros/src/am2315/msg/Environment.msg" NAME_WE)
add_dependencies(am2315_generate_messages_nodejs _am2315_generate_messages_check_deps_${_filename})

# target for backward compatibility
add_custom_target(am2315_gennodejs)
add_dependencies(am2315_gennodejs am2315_generate_messages_nodejs)

# register target for catkin_package(EXPORTED_TARGETS)
list(APPEND ${PROJECT_NAME}_EXPORTED_TARGETS am2315_generate_messages_nodejs)

### Section generating for lang: genpy
### Generating Messages
_generate_msg_py(am2315
  "/home/ubuntu/PiGreenhouse/src/ros/src/am2315/msg/Environment.msg"
  "${MSG_I_FLAGS}"
  "/opt/ros/melodic/share/std_msgs/cmake/../msg/Header.msg"
  ${CATKIN_DEVEL_PREFIX}/${genpy_INSTALL_DIR}/am2315
)

### Generating Services

### Generating Module File
_generate_module_py(am2315
  ${CATKIN_DEVEL_PREFIX}/${genpy_INSTALL_DIR}/am2315
  "${ALL_GEN_OUTPUT_FILES_py}"
)

add_custom_target(am2315_generate_messages_py
  DEPENDS ${ALL_GEN_OUTPUT_FILES_py}
)
add_dependencies(am2315_generate_messages am2315_generate_messages_py)

# add dependencies to all check dependencies targets
get_filename_component(_filename "/home/ubuntu/PiGreenhouse/src/ros/src/am2315/msg/Environment.msg" NAME_WE)
add_dependencies(am2315_generate_messages_py _am2315_generate_messages_check_deps_${_filename})

# target for backward compatibility
add_custom_target(am2315_genpy)
add_dependencies(am2315_genpy am2315_generate_messages_py)

# register target for catkin_package(EXPORTED_TARGETS)
list(APPEND ${PROJECT_NAME}_EXPORTED_TARGETS am2315_generate_messages_py)



if(gencpp_INSTALL_DIR AND EXISTS ${CATKIN_DEVEL_PREFIX}/${gencpp_INSTALL_DIR}/am2315)
  # install generated code
  install(
    DIRECTORY ${CATKIN_DEVEL_PREFIX}/${gencpp_INSTALL_DIR}/am2315
    DESTINATION ${gencpp_INSTALL_DIR}
  )
endif()
if(TARGET std_msgs_generate_messages_cpp)
  add_dependencies(am2315_generate_messages_cpp std_msgs_generate_messages_cpp)
endif()

if(geneus_INSTALL_DIR AND EXISTS ${CATKIN_DEVEL_PREFIX}/${geneus_INSTALL_DIR}/am2315)
  # install generated code
  install(
    DIRECTORY ${CATKIN_DEVEL_PREFIX}/${geneus_INSTALL_DIR}/am2315
    DESTINATION ${geneus_INSTALL_DIR}
  )
endif()
if(TARGET std_msgs_generate_messages_eus)
  add_dependencies(am2315_generate_messages_eus std_msgs_generate_messages_eus)
endif()

if(genlisp_INSTALL_DIR AND EXISTS ${CATKIN_DEVEL_PREFIX}/${genlisp_INSTALL_DIR}/am2315)
  # install generated code
  install(
    DIRECTORY ${CATKIN_DEVEL_PREFIX}/${genlisp_INSTALL_DIR}/am2315
    DESTINATION ${genlisp_INSTALL_DIR}
  )
endif()
if(TARGET std_msgs_generate_messages_lisp)
  add_dependencies(am2315_generate_messages_lisp std_msgs_generate_messages_lisp)
endif()

if(gennodejs_INSTALL_DIR AND EXISTS ${CATKIN_DEVEL_PREFIX}/${gennodejs_INSTALL_DIR}/am2315)
  # install generated code
  install(
    DIRECTORY ${CATKIN_DEVEL_PREFIX}/${gennodejs_INSTALL_DIR}/am2315
    DESTINATION ${gennodejs_INSTALL_DIR}
  )
endif()
if(TARGET std_msgs_generate_messages_nodejs)
  add_dependencies(am2315_generate_messages_nodejs std_msgs_generate_messages_nodejs)
endif()

if(genpy_INSTALL_DIR AND EXISTS ${CATKIN_DEVEL_PREFIX}/${genpy_INSTALL_DIR}/am2315)
  install(CODE "execute_process(COMMAND \"/usr/bin/python2\" -m compileall \"${CATKIN_DEVEL_PREFIX}/${genpy_INSTALL_DIR}/am2315\")")
  # install generated code
  install(
    DIRECTORY ${CATKIN_DEVEL_PREFIX}/${genpy_INSTALL_DIR}/am2315
    DESTINATION ${genpy_INSTALL_DIR}
  )
endif()
if(TARGET std_msgs_generate_messages_py)
  add_dependencies(am2315_generate_messages_py std_msgs_generate_messages_py)
endif()
