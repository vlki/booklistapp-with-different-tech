# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.shortcuts import render
from django.http import HttpResponse

from .models import Book


def index(request):
    books = Book.objects.all()
    return render(request, 'books/index.html', {'books': books})

def delete():
    return HttpResponse('TBD')

def create():
    return HttpResponse('TBD')
