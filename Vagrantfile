# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
    config.vm.box = "laravel/homestead"
    config.vm.provider "vmware_desktop" do |v|
      v.gui = false
    end
    config.vm.usable_port_range = 999..8999
end
