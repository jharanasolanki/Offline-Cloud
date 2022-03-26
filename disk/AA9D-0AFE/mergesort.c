#include<stdio.h>
#define MAX 100
int arr[MAX];
int merge(int low,int mid, int high)
{
	int arr2[MAX];
	int i,j,k;
	i=low;
	j=mid+1;
	k=low;
	while(i<=mid && j<=high)
	{
		if(arr[i]<arr[j])
		{
			arr2[k]=arr[i];
			k++;
			i++;
		}	
		else
		{
			arr2[k]=arr[j];
			k++;
			j++;
		}
	}
	if(i>mid)
	{
		while(j<=high)
		{
			arr2[k]=arr[j];
			k++;
			j++;
		}
	}
	if(j>high)
	{
		while(i<=mid)
		{
			arr2[k]=arr[i];
			k++;
			i++;
		}
	}
	for(i=low;i<=high;i++)
	{
		arr[i]=arr2[i];
	}
}
int mergesort(int low, int high)
{
	int mid;
	if(low<high)
	{
		mid=(high+low)/2;
	
	mergesort(low,mid);
	mergesort(mid+1,high);
	merge(low,mid,high);
}
}
int main()
{
	int n,i;
	scanf("%d",&n);
	for(i=0;i<n;i++)
	{
		scanf("%d",&arr[i]);
	}
	mergesort(0,n-1);
	for(i=0;i<n;i++)
	{
		printf("%d\t",arr[i]);
	}
	return 0;
}
