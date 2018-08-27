# http://isizov.ru/ustanovka-docker-na-ubuntu-16-04/
sudo apt-get update
sudo apt-key adv --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys 58118E89F3A912897C070ADBF76221572C52609D
sudo apt-add-repository 'deb https://apt.dockerproject.org/repo ubuntu-xenial main'
sudo apt-get update
apt-cache policy docker-engine
sudo apt-get install -y docker-engine
sudo systemctl status docker

sudo groupadd docker
sudo useradd -g docker docker
sudo passwd -d docker

sudo usermod -aG docker $(whoami)
sudo usermod -aG docker docker

cd /home/ && mkdir docker && cd docker && chown docker:docker . && ls -al

# https://docs.docker.com/machine/install-machine/#install-machine-directly
apt-get install -y curl
base=https://github.com/docker/machine/releases/download/v0.14.0 && curl -L $base/docker-machine-$(uname -s)-$(uname -m) >/tmp/docker-machine && sudo install /tmp/docker-machine /usr/local/bin/docker-machine
docker-machine version

base=https://raw.githubusercontent.com/docker/machine/v0.14.0
for i in docker-machine-prompt.bash docker-machine-wrapper.bash docker-machine.bash
do
  sudo wget "$base/contrib/completion/bash/${i}" -P /etc/bash_completion.d
done
source /etc/bash_completion.d/docker-machine-prompt.bash
PS1='[\u@\h \W$(__docker_machine_ps1)]\$ '