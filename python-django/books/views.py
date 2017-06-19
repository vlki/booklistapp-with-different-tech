# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.shortcuts import get_object_or_404, render, redirect
from django.core.exceptions import SuspiciousOperation

from .models import Book
from .forms import CreateBookForm

def index(request):
    books = Book.objects.all()
    return render(request, 'books/index.html', {'books': books})

def delete(request, book_id):
	book = get_object_or_404(Book, pk=book_id)
	book.delete()

	return redirect('index')

def create(request):
	if request.method != 'POST':
		raise SuspiciousOperation("POST method only allowed with this endpoint")

	form = CreateBookForm(request.POST)
	if not form.is_valid():
		raise SuspiciousOperation("You must pass title as parameter in HTTP POST request body")

	book = Book(title=form.cleaned_data['title'])
	book.save()

	return redirect('index')
