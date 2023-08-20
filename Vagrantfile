# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
    config.vm.box = "generic/ubuntu1804"  # or another suitable box
    config.vm.synced_folder "./", "/home/vagrant/app"
    config.vm.network "public_network", type: "dhcp", use_dhcp_assigned_default_route: true
    config.vm.provision "docker"
    config.vm.provider "vmware_desktop" do |v|
        v.gui = false
    end
end
