# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "laravel/homestead"
  config.vm.synced_folder "./", "/Private/API/Services/Golf API/Codebase"
  config.vm.provider "vmware_desktop" do |v|
      v.gui = true
    end
end
