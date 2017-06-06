# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.conf.urls import url

from . import views

urlpatterns = [
    url(r'^$', views.index, name='index'),
    url(r'^delete-book/(?P<book_id>[0-9]+)$', views.delete, name='delete'),
    url(r'^create-book$', views.create, name='create'),
]
